import $ from 'jquery'
import Observer from "../../../utils/Observer";
import {getTypeByInputType} from "../../../utils/helpers";

export const ON_CHANGE_INPUTS = 'change'

export default class ControlSettings extends Observer {

  $elementBox

  constructor($elementBox) {
    super();

    this.$elementBox = $elementBox
    this._initInputs()
  }

  _initInputs() {
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
          action,
        })
      })
  }

  setInputData(data = {}) {
    Object.keys(data).forEach((key) => {
      const $element = this.$elementBox.find(`[name="${key}"]`)
      $element.val(data[key])
    })
  }
}