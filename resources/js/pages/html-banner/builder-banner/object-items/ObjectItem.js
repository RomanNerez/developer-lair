import Observer from '$utils/Observer'

const templateObject = `
    <div class="object-item"></div>
`;

export default class ObjectItem extends Observer {

    $element = null

    left = 0
    top = 0
    width = 0
    height = 0
    angle = 0
    backgroundColor = '#000000'
    zIndex = 1

    constructor() {
        super()
        this.$element = $(templateObject)
    }

    _initSettings() {
        this.$element.css({
            backgroundColor: this.backgroundColor,
            left: `${this.left}px`,
            top: `${this.top}px`,
            width: `${this.width}px`,
            height: `${this.height}px`,
            zIndex: this.isActive ? 99 : this.zIndex
        })
    }

    init() {
        this._initSettings()
    }

    set(settings = {}) {
        for(let key in settings) {
            this[key] = settings[key]
        }

        this._initSettings()
    }
}
