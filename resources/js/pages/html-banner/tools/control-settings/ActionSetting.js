

export default class ActionSetting {

    _type = null
    _content = null
    _forTypes = []
    _handlers = []

    constructor(settings) {
        this._type = settings.type
        this._content = settings.content
        this._forTypes = settings.forTypes || this._forTypes
        this._handlers = settings.handlers || this._handlers
    }

    _init() {
        this._content = $(this._content)

        this._handlers.forEach(handler => {
            const selector = this._content.find(handler.selector)

            const events = handler

        })

    }

    getNode() {
        this._init()

        return this._content
    }
}