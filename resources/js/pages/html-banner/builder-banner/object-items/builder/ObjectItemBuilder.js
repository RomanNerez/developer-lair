import ObjectItem from "../ObjectItem"

const ON_MOVING = 'moving'
const ON_MOVE_END = 'move-end'

export default class ObjectItemBuilder extends ObjectItem {

    banner = null

    isActive = false

    constructor() {
        super()
    }

    _activeObjectTools() {
        this._initResizable()
        this._initRotatable()
        this._initDraggable()
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
                this.banner.setActiveObject(this)
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
            start: () => {
                this.banner.setActiveObject(this)
            },
            drag: (event, ui) => {
                this.left = ui.position.left
                this.top = ui.position.top

                this._initResizable()
                this._initRotatable()

                this.dispatch(ON_MOVING, {object: this})
            },
            stop: (event, ui) => {
                this.dispatch(ON_MOVE_END, {object: this})
            }
        })
    }

    getAbsoluteCoordByWrapContainer() {
        const position = this.banner._$elementBannerContainer.position()

        return {
            left: position.left - this.banner.width / 2 + this.left,
            top: position.top - this.banner.height / 2 + this.top
        }
    }

    init() {
        super.init()
        this._initEvents()
        this._activeObjectTools()
        if (this.isActive) this.setActive()
    }

    setActive() {
        this.isActive = true
        this.$element.addClass('active')
        this._initSettings()
    }

    unsetActive() {
        this.isActive = false
        this.$element.removeClass('active')
        this._initSettings()
    }
}

ObjectItemBuilder.ON_MOVING = ON_MOVING
ObjectItemBuilder.ON_MOVE_END = ON_MOVE_END
