class Observer {
  events = {}

  dispatch(event, data) {
    if (!this.events[event]) return

    this.events[event].forEach(callback => callback(data))
  }

  on(event, callback) {
    if (!this.events[event]) this.events[event] = []
    if (typeof callback !== 'function') {
      return
    }

    this.events[event].push(callback)
  }

  off(event) {
    delete this.events[event]
  }
}

export default Observer