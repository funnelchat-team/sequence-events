<template>
  <default-field :field="field" :errors="errors">
    <template slot="field">
      <div>
        <form class="w-full">
          <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
              <label
                class="inline-block text-80 pt-2 leading-tight"
                for="inline-full-name"
              >
                {{ __("Type") }}
              </label>
            </div>
            <div class="md:w-2/3">
              <multiselect
                v-model="type_selected"
                track-by="data"
                label="label"
                :placeholder="__('select option')"
                :selectLabel="__('to select')"
                :deselectLabel="__('press enter to remove')"
                :deselectGroupLabel="__('press enter to deselect group')"
                :selectGroupLabel="__('press enter to select group')"
                :selectedLabel="__('selected')"
                :options="field.options"
              >
                <span slot="noResult"
                  >{{
                    __(
                      "No elements found. Consider changing the search query."
                    )
                  }}.</span
                >
                <span slot="noOptions">{{ __("List is empty") }}.</span>
                >
              </multiselect>
            </div>
          </div>

          <div v-if="type_selected.data == 'Duration'">
            <div class="md:flex md:items-center mb-6">
              <div class="md:w-1/3">
                <label
                  class="inline-block text-80 pt-2 leading-tight"
                  for="inline-full-name"
                >
                  {{ __("Duration") }}
                </label>
              </div>
              <div class="md:w-2/3">
                <multiselect
                  v-model="selected_duration_type"
                  track-by="data"
                  label="label"
                  :placeholder="__('select option')"
                  :selectLabel="__('to select')"
                  :deselectLabel="__('press enter to remove')"
                  :deselectGroupLabel="__('press enter to deselect group')"
                  :selectGroupLabel="__('press enter to select group')"
                  :selectedLabel="__('selected')"
                  :options="field.duration_type_collect"
                >
                  <span slot="noResult"
                    >{{
                      __(
                        "No elements found. Consider changing the search query."
                      )
                    }}.</span
                  >
                  <span slot="noOptions">{{ __("List is empty") }}.</span>
                  ></multiselect
                >
              </div>
            </div>
            <div class="md:flex md:items-center mb-6">
              <div class="md:w-1/3">
                <label
                  class="inline-block text-80 pt-2 leading-tight"
                  for="inline-full-name"
                >
                  {{ __("Time") }}
                </label>
              </div>
              <div class="md:w-2/3">
                <input
                  v-model="selected_cant"
                  type="number"
                  class="w-full form-control form-input form-input-bordered"
                />
              </div>
            </div>
          </div>
          <div v-if="type_selected.data == 'Day is'">
            <div class="md:flex md:items-center mb-6">
              <div class="md:w-1/3">
                <label
                  class="inline-block text-80 pt-2 leading-tight"
                  for="inline-full-name"
                >
                  {{ __("Day is") }}
                </label>
              </div>
              <div class="md:w-2/3">
                <multiselect
                  v-model="selected_day_is"
                  track-by="data"
                  label="label"
                  :placeholder="__('select option')"
                  :selectLabel="__('to select')"
                  :deselectLabel="__('press enter to remove')"
                  :deselectGroupLabel="__('press enter to deselect group')"
                  :selectGroupLabel="__('press enter to select group')"
                  :selectedLabel="__('selected')"
                  :options="field.day_is_collect"
                >
                  <span slot="noResult"
                    >{{
                      __(
                        "No elements found. Consider changing the search query."
                      )
                    }}.</span
                  >
                  <span slot="noOptions">{{ __("List is empty") }}.</span>
                </multiselect>
              </div>
            </div>
            <div class="md:flex md:items-center mb-6">
              <div class="md:w-1/3">
                <label
                  class="inline-block text-80 pt-2 leading-tight"
                  for="inline-full-name"
                >
                  {{ __("Time") }}
                </label>
              </div>
              <div class="md:w-2/3">
                <!-- <div>
                  <flat-pickr v-model="selected_time"></flat-pickr>
                </div> -->
                <input
                  v-model="selected_time"
                  type="time"
                  class="w-full form-control form-input form-input-bordered"
                />
                <span class="text-80 text-sm ml-2">{{
                  resolved_options.timeZone
                }}</span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";
import Multiselect from "vue-multiselect";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  mixins: [FormField, HandlesValidationErrors],

  components: { Multiselect, flatPickr },

  data() {
    return {
      time_value: null,
      type_selected: { label: null, data: null },
      selected_day_is: this.getDay(),
      selected_time: "00:00",
      selected_duration_type: null,
      selected_cant: null,
      resolved_options: Intl.DateTimeFormat().resolvedOptions(),
    };
  },

  props: ["resourceName", "resourceId", "field"],

  watch: {
    selected_day_is: function (newDay, oldDay) {
      this.value = JSON.stringify({
        type_selected: this.type_selected.data,
        selected_day_is: newDay.data,
        selected_time: "00:00",
      });
    },
    selected_time: function (newTime, oldTime) {
      this.value = JSON.stringify({
        type_selected: this.type_selected.data,
        selected_day_is: this.selected_day_is.data,
        selected_time: newTime + " " + this.resolved_options.timeZone,
      });
    },
    selected_duration_type: function (newHour, oldHour) {
      this.value = JSON.stringify({
        type_selected: this.type_selected.data,
        selected_duration_type: newHour.data,
        selected_cant: 1,
      });
    },
    selected_cant: function (newCant, oldCant) {
      this.value = JSON.stringify({
        type_selected: this.type_selected.data,
        selected_duration_type: this.selected_duration_type.data,
        selected_cant: newCant,
      });
    },
  },

  mounted() {},

  methods: {
    inputHandler(eventData) {},

    getDay() {
      let days = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday",
      ];
      return days[new Date().getDay()];
    },

    setInitialValue() {
      if (this.field.value) {
        let val = JSON.parse(this.field.value);
        this.type_selected = this.field.options.filter(
          (item) => val.type_selected == item.data
        )[0];
        if (val.type_selected == "Day is") {
          this.selected_day_is = this.field.day_is_collect.filter(
            (item) => val.selected_day_is == item.data
          )[0];
          this.selected_time = val.selected_time.split(" ")[0];
        } else {
          this.selected_duration_type = this.field.duration_type_collect.filter(
            (item) => val.selected_duration_type == item.data
          )[0];
          this.selected_cant = val.selected_cant;
        }
      }
    },

    fill(formData) {
      formData.append(this.field.attribute, this.value || "");
    },

    handleChange(value) {
      this.value = value;
    },
  },
};
</script>