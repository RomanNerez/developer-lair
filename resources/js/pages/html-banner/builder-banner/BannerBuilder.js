import Banner from "./Banner";


const ON_SELECTED_OBJECT = 'selected-object'
const ON_CANCEL_SELECT_OBJECT = 'cancel-select-object'

export default class BannerBuilder extends Banner {

    _activeObject = null
    unsetActiveObjectHandlers = [
        '.object-item',
        '#control-settings'
    ]

    constructor($elementBannerContainer, options = {}) {
        super($elementBannerContainer, options)
        this._initEvents()
    }

    _initEvents() {
        const handlerUnsetActiveObjectClick = (event) => {
            const isUnset = this.unsetActiveObjectHandlers.find(
                (handler) => $(event.target).closest(handler).length
            )

            if (!isUnset) {
                this.unsetActiveObject()     
            }
        }

        $(document).on('click', handlerUnsetActiveObjectClick)
    }

    setActiveObject(object) {
        this._checkObject(object)

        if (this._activeObject === object) return

        if (this._activeObject) {
            this._activeObject.unsetActive()
        }

        this._activeObject = object
        this._activeObject.setActive()
        this.dispatch(ON_SELECTED_OBJECT, { object })
    }

    add(object) {
        super.add(object)
        object.banner = this
    }

    remove(object) {
        super.remove(object)
        if (this._activeObject === object) {
            this.unsetActiveObject()
        }
    }

    unsetActiveObject() {
        if (this._activeObject) {
            this._activeObject.unsetActive()
        }

        this._activeObject = null;
        this.dispatch(ON_CANCEL_SELECT_OBJECT, {})
    }

    togglePreview() {
        this._$elementBannerContainer.toggleClass('preview-active')
    }
}

BannerBuilder.ON_SELECTED_OBJECT = ON_SELECTED_OBJECT
BannerBuilder.ON_CANCEL_SELECT_OBJECT = ON_CANCEL_SELECT_OBJECT