const ACTION_SELECT_COLOR = 'select-color';
const ACTION_DELETE = 'delete';


const commonActions = [
    {
        type: ACTION_SELECT_COLOR,
        content: `
            <span class="action" title="Select Color">
                <div class="dropdown">
                    <span data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-palette"></i>
                    </span>
                    <div class="dropdown-menu p-3">
                        <div class="d-flex">
                            <input type="text" class="form-control">
                            <input type="color" class="form-control">
                        </div>
                    </div>
                </div>
            </span>
        `,
        // for: ['rect', 'text', 'image'],
        // onInit: (node, object) => {
            
        // },
        // handlers: [{
        //     selector: '"type="text"',
        //     type: 'input, change'
        //     func: (event, node, object) => {

        //     }
        // },]
    },
    {
        type: ACTION_DELETE,
        content: `
            <span class="action" title="Delete">
                <i class="fas fa-trash-alt"></i>
            </span>
        `,
        for: ['rect', 'text', 'image'],
    },
];

const handlers = {
    delete(node, object, event) {
        object.banner.remove(object)
    },
    selectColor(node, object, event) {
        const color = event.target.value;
        node.find('input[type="text"]').val(color)
        object.set({
            backgroundColor: color
        })
    }
}


const initEvents = {
    [ACTION_DELETE]: (node, object) => {
        node.on('click', function(event) {
            handlers.delete(node, object, event)
        })
    },
    [ACTION_SELECT_COLOR]: (node, object) => {
        node.find('input').on('input', function(event) {
            handlers.selectColor(node, object, event)
        })
    }
}

const initValues = {
    [ACTION_SELECT_COLOR]: (node, object) => {
        node.find('input').val(object.backgroundColor)
    }
}


export default function initActions($element, object) {
    $element.find('.action:not(.draggable)').remove()
    
    commonActions.forEach(action => {
        const node = $(action.content);

        if (initEvents[action.type]) {
            initEvents[action.type](node, object);
        }

        if (initValues[action.type]) {
            initValues[action.type](node, object);
        }
        

        $element.find('.canvas_banner-item-settings-content')
            .append(node)
    })
}