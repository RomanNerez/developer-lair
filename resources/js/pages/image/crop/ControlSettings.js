import $ from 'jquery'
import Observer from "../../../utils/Observer";
import {getTypeByInputType} from "../../../utils/helpers";

export const ON_CHANGE_INPUTS = 'change'

export default class ControlSettings extends Observer {

  $elementBox
  currentImageInstance = null

  constructor($elementBox) {
    super();

    this.$elementBox = $elementBox
    this._initInputs()
  }

  _initInputs() {
    const actionAlias = { x: 'left', y: 'top' }
    this.$elementBox
      .find('input')
      .on('input' , (event) => {
        const $element = $(event.currentTarget)
        const action = $element.data('action')
        const type = $element.attr('type')
        const value = $element.val()
        this.dispatch(ON_CHANGE_INPUTS, {
          event,
          value: getTypeByInputType(type, value),
          action: actionAlias[action] ? actionAlias[action] : action,
          valueCropper: this._getCropperValue(action, getTypeByInputType(type, value))
        })
      })
  }

  setImage(imageElement) {
    this.currentImageInstance = imageElement
  }

  _getCropperValue(key, value) {
    const ratioX = this.currentImageInstance.containerData.width / this.currentImageInstance.width
    const ratioY = this.currentImageInstance.containerData.height / this.currentImageInstance.height
    return parseInt((value * (['left', 'width'].includes(key) ? ratioX : ratioY)).toFixed(0))
  }

  _getValue(key, value) {
    const ratioX = this.currentImageInstance.containerData.width / this.currentImageInstance.width
    const ratioY = this.currentImageInstance.containerData.height / this.currentImageInstance.height
    return (value / (['left', 'width'].includes(key) ? ratioX : ratioY)).toFixed(0)
  }

  setInputData(data = {}) {
    Object.keys(data).forEach((key) => {
      const $element = this.$elementBox.find(`[name="${key}"]`)
      $element.val(this._getValue(key, data[key]))
      this.currentImageInstance.setInputData(key, this._getValue(key, data[key]))
      $element.data(key, data[key])
    })
  }

}