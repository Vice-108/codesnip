import { GoogleGenAI } from '@google/genai';
import { ref } from 'vue';

const ai = new GoogleGenAI({ apiKey: import.meta.env.VITE_GEMINI_API_KEY });
interface reviewObjectType {
    title: string;
    description: string | null;
    code: string;
}
export default function useGemini() {
    const result = ref<string | null>(null);
    const loading = ref(false);
    const error = ref<Error | null>(null);

    async function generateContent(prompt: reviewObjectType, systemInstruction: string) {
        loading.value = true;
        error.value = null;
        try {
            const response = await ai.models.generateContent({
                model: 'gemini-2.0-flash',
                contents: [
                    {
                        role: 'user',
                        parts: [{ text: `Title: ${prompt.title}\nDescription: ${prompt.description}\nCode:\n${prompt.code}` }],
                    },
                ],
                config: {
                    systemInstruction: systemInstruction,
                },
            });
            // The Gemini API returns candidates, not .text directly
            result.value = response.candidates?.[0]?.content?.parts?.[0]?.text ?? null;
        } catch (err) {
            error.value = err as Error;
        } finally {
            loading.value = false;
        }
    }

    return { result, loading, error, generateContent };
}
