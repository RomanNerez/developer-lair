import $ from "jquery"

export default class SettingsControl {

  events = {}
  element
  alias = {
    'x': 'left',
    'y': 'top',
  }

  constructor(element) {
    this.element = $(element).get(0)
    if (!this.element) throw Error('Element not found')

    this.__initInput()
  }

  __initInput() {
    $('input', this.element).on('input', event => {
      const element = $(event.target)
      const data = element.data()
      const type = element.prop('type')
      this.dispatchEvent('input', event, {
        ...data,
        value: type === 'number' ? parseFloat(element.val()) : element.val()
      })
    })
  }

  dispatchEvent(eventType, eventData, data = {}) {
    if (!this.events[eventType]) return

    this.events[eventType].forEach(callback => {
      callback({
        action: eventType,
        originEvent: eventData,
        target: {
          ...data
        }
      })
    })
  }

  hide() {
    $('#info-data-element', this.element).hide()
  }

  show() {
    $('#info-data-element', this.element).show()
  }


  on(event, callback) {
    if (!this.events[event]) this.events[event] = []

    this.events[event].push(callback)
  }
}