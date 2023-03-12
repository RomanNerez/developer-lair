export default class ObjectItemTools {


    _initEvents() {
        const handlerClick = () => {
            this.banner.setActiveObject(this)
        }

        this.$element
        .off('click', '.object-item', handlerClick)
        .on('click', handlerClick)
    }
    
}