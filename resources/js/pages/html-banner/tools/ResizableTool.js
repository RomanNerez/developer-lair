import '../../plugins/resizable';

function init(objectItem) {
    Object.keys(ResizableTool).forEach((key) => {
        objectItem[key] = ResizableTool[key].bind(objectItem)
    })
}


const ResizableTool = {

    _activeObjectTools() {
        this._initResizable()
        this._initRotatable()
        this._initDraggable()
    }

    _destroyObjectTools() {
        this.$element.resizable('destroy')
        this.$element.rotatable('destroy')
        this.$element.draggable('destroy')
    }

    _initEvents() {
        const handlerClick = () => {
            this.banner.setActiveObject(this)
        }

        this.$element
        .off('click', '.object-item', handlerClick)
        .on('click', handlerClick)
    }

    _initResizable() {
        this.$element.resizable({
            handles: "all",
            start: (event, ui) => {
                const handle = $(event.originalEvent.target)
                const handlesPoint = ['ne', 'se', 'sw', 'nw'];
                const pointExists = handlesPoint.find(
                    handlePoint => handle.hasClass(`ui-resizable-${handlePoint}`)
                );
                
                if (pointExists) {
                    this.$element.resizable('option', 'aspectRatio', true)
                }
            },
            resize: (event, ui) => {
                this.left = ui.position.left
                this.top = ui.position.top
                this.width = ui.size.width
                this.height = ui.size.height

                this._initRotatable()
                this._initDraggable()
            },
            stop: () => {
                this.$element.resizable('option', 'aspectRatio', false)
            }
        })
    }

    _initRotatable() {
        var params = {
            wheelRotate: false,
            rotate: (event, ui) => {
                this.angle = ui.api.elementCurrentAngle

                this._initDraggable()
                this._initResizable()
            },
        };
        this.$element.rotatable(params)
        this.$element.rotatable('ui').api.angle(this.angle)
    }

    _initDraggable() {
        this.$element.draggable({
            drag: (event, ui) => {
                this.left = ui.position.left
                this.top = ui.position.top

                this._initResizable()
                this._initRotatable()
            }
        })
    }

    setActive() {
        this.isActive = true
        this._activeObjectTools()
        this._initSettings()
    }

    unsetActive() {
        this.isActive = false
        this._destroyObjectTools()
        this._initSettings()
    }

}