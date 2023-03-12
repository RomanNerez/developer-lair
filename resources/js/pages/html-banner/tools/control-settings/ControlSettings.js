import ObjectItemBuilder from '../../builder-banner/object-items/builder/ObjectItemBuilder'
import ControlSettingsException from '../../exceptions/ControlSettingsException'
import ActionSetting from './ActionSetting';
import getPoints from './utils/position-calculate'
import initActions from './utils/default-actions'

export default class ControlSettings {

    _$element = null
    _object = null
    _actions = []

    _left = 0
    _top = 0

    constructor($element) {
        this._$element = $element
        this._initEvents()
        this._initDraggable()
        this._actions = []
    }

    _initEvents() {
        this._$element
    }

    _initDraggable() {
        
        this._$element.draggable({
            handle: ".draggable"
        })
    }

    __addListenersForObject() {
        const handlerMoving = () => {
            this.hide()
        }

        const handlerMoveEnd = () => {
            this.show()
            this.setPosition()
        }

        this._object
            .off(ObjectItemBuilder.ON_MOVING, handlerMoving)
            .off(ObjectItemBuilder.ON_MOVE_END, handlerMoveEnd)
            .on({
                [ObjectItemBuilder.ON_MOVING]: handlerMoving,
                [ObjectItemBuilder.ON_MOVE_END]: handlerMoveEnd
            })
    }

    __initActions() {
        this.actions.forEach((action) => {
            this._$element.append(
                action.getNode()
            )
        })
    }

    setObject(object) {
        if (!object) {
            this.hide()
            return
        }

        this._object = object
        this.__addListenersForObject()

        initActions(this._$element, object)

        this.show()
        this.setPosition()
    }

    show() {
        this._$element.show()
    }

    hide() {
        this._$element.hide()
    }

    setPosition() {
        const coordinate = this._object.getAbsoluteCoordByWrapContainer()

        const {left, top } = getPoints(
            this._$element,
            {
                left: coordinate.left,
                top: coordinate.top,
                width: this._object.width,
                height: this._object.height
            }
        )

        this._$element.css({
            left: `${left}px`,
            top: `${top}px`
        })
    }

    addAction(action) {
        if (!(action instanceof ActionSetting)) {
            throw new ControlSettingsException('test')
        }
        this._$element.find('.action:not(.draggable)').remove()
        this.action.push(action)
        this.__initActions()
    }
}