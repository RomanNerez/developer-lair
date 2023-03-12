export default class Observer {
  events = {}

  _checkCallback(callback) {
    if (typeof callback !== 'function') {
      throw new Error('Callback must be a function type')
    }
  }

  _addEvent(event, callback) {
    if (!this.events[event]) this.events[event] = []
    this.events[event].push(callback)
  }

  on(event, callback) {

    if (typeof event === 'object' && !Array.isArray(event)) {
      for (let key in event) {
        this._checkCallback(event[key])
        this._addEvent(key, event[key])
      }
    } else {
      this._checkCallback(callback)
      this._addEvent(event, callback)
    }

    return this
  }

  off(event, callback) {
    if (!this.events[event]) return this
    
    this.events[event] = this.events[event].filter(
      (call) => call.toString() !== callback.toString()
    )

    return this
  }

  dispatch(event, data) {
    if (!this.events[event]) return
    this.events[event].forEach((callback) => {
      callback(data)
    })
  }
}
