import CodeMirror from 'codemirror'
import 'codemirror/addon/edit/matchbrackets'
import 'codemirror/addon/scroll/simplescrollbars'
import 'codemirror/mode/xml/xml'
import 'codemirror/mode/javascript/javascript'
import 'codemirror/mode/css/css'
import 'codemirror/mode/vbscript/vbscript'
import 'codemirror/mode/clike/clike'
import 'codemirror/mode/htmlmixed/htmlmixed'
import 'codemirror/addon/display/autorefresh'
import 'codemirror/addon/display/fullscreen'
import 'codemirror/addon/fold/foldcode'
import 'codemirror/addon/fold/foldgutter'
import 'codemirror/addon/fold/brace-fold'
import 'codemirror/addon/fold/xml-fold'
import 'codemirror/addon/fold/indent-fold'
import 'codemirror/addon/fold/comment-fold'
import 'codemirror/addon/fold/comment-fold'

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
        scrollbarStyle: 'simple',
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        extraKeys: {
            "Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); },
            "F11": function(cm) {
                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            }
        }
    })
})
