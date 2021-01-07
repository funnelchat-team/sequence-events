<template>
    <div class="w-full remove-bottom-border">
        <div class="flex border-b border-40 flex-col">
            <div class="pt-6 w-full">
                <h4 class="font-normal text-80">{{ __(title) }}</h4>
            </div>
        </div>

        <div class="py-4 break-words w-full">
            <div class="flex mb-4">
                <div class="w-1/4 p-2">
                    <p class="text-90 pl-2">
                        <b>{{ __("Duration type") }}:</b>
                    </p>
                    <div
                        class="relative rounded-lg bg-white shadow border border-60"
                    >
                        <div class="overflow-hidden rounded-b-lg rounded-t-lg">
                            <div
                                class="border-b border-50 cursor-text font-mono text-sm py-2 px-4"
                            >
                                {{ __(type_selected) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-1/4 p-2" v-if="type_selected == 'Day is'">
                    <p class="text-90 pl-2">
                        <b>{{ __("Day is") }}:</b>
                    </p>
                    <div
                        class="relative rounded-lg bg-white shadow border border-60"
                    >
                        <div class="overflow-hidden rounded-b-lg rounded-t-lg">
                            <div
                                class="border-b border-50 cursor-text font-mono text-sm py-2 px-4"
                            >
                                {{
                                    __(selected_day_is) +
                                        " " +
                                        " " +
                                        selected_time
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/4 p-2" v-else>
                    <p class="text-90 pl-2">
                        <b>{{ __("Time") }}:</b>
                    </p>
                    <div
                        class="relative rounded-lg bg-white shadow border border-60"
                    >
                        <div class="overflow-hidden rounded-b-lg rounded-t-lg">
                            <div
                                class="border-b border-50 cursor-text font-mono text-sm py-2 px-4"
                            >
                                {{
                                    selected_cant +
                                        " " +
                                        " " +
                                        __(selected_duration_type)
                                }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["resource", "resourceName", "resourceId", "field"],
    computed: {
        valueDetail() {
            return JSON.parse(this.field.value);
        },
        title() {
            return this.field.name;
        },
        type_selected() {
            return this.valueDetail.type_selected;
        },
        selected_day_is() {
            return this.valueDetail.selected_day_is;
        },
        selected_time() {
            return this.valueDetail.selected_time;
        },
        selected_duration_type() {
            return this.valueDetail.selected_duration_type;
        },
        selected_cant() {
            return this.valueDetail.selected_cant;
        }
    },
    mounted() {
        console.log(this.valueDetail);
    }
};
</script>
