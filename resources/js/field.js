Nova.booting((Vue, router, store) => {
  Vue.component('index-sequence-events', require('./components/IndexField'))
  Vue.component('detail-sequence-events', require('./components/DetailField'))
  Vue.component('form-sequence-events', require('./components/FormField'))
})
