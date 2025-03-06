import MarkdownIt from 'markdown-it'
import hljs from 'highlight.js'

interface HighlightOptions {
    language: string;
}

const md = new MarkdownIt({
    highlight: function (code: string, lang: string): string {
        let highlightedCode: string
        if (lang && hljs.getLanguage(lang)) {
            highlightedCode = hljs.highlight(code, { language: lang } as HighlightOptions).value
        } else {
            const detected = hljs.highlightAuto(code)
            highlightedCode = detected.value
            lang = detected.language || 'plaintext'
        }
        return `<pre><code class="hljs ${lang} p-0 m-0">${highlightedCode}</code></pre>`
    },
})

export default function useMarkdown(text: string): string {
    return md.render(text)
}
