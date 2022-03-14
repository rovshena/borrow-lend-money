import CodeMirror from 'codemirror'
import 'codemirror/addon/edit/matchbrackets'
import 'codemirror/mode/xml/xml'
import 'codemirror/mode/javascript/javascript'
import 'codemirror/mode/css/css'
import 'codemirror/mode/vbscript/vbscript'
import 'codemirror/mode/htmlmixed/htmlmixed'
import 'codemirror/addon/display/autorefresh'

const textarea = document.querySelectorAll('.code-mirror')
textarea.forEach((element) => {
    const editor = CodeMirror.fromTextArea(document.getElementById(element.id), {
        lineNumbers: true,
        theme: 'darcula',
        matchBrackets: true,
        mode: 'htmlmixed',
        autoRefresh: true,
        indentUnit: 4,
        indentWithTabs: true,
        tabSize: 4,
        lineWrapping: true,
    })
})
