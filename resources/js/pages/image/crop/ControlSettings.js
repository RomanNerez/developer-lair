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
      .on('input' , (event) => this.dispatch(ON_CHANGE_INPUTS, {
        event,
        value: getTypeByInputType(event.currentTarget.type, event.currentTarget?.value),
        action: event.currentTarget?.dataset?.action
    }))
  }

  setInputData(data = {}) {
    Object.keys(data).forEach((key) => {
      this.$elementBox.find(`[name="${key}"]`).val(data[key])
    })
  }

}