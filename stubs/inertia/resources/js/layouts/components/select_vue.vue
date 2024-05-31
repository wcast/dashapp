<template>
    <div>
        <VueMultiselect
            placeholder="Selecione a empresa"
            v-model="model"
            label=""
            :close-on-select="true"
            :show-labels="false"
            track-by="id"
            :custom-label="customLabel"
            :options="itens">
        </VueMultiselect>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect'
export default {
    props: {
        modelValue: {
            type: null,
            default () {
                return []
            }
        },
        itens: Object,
        value: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: ''
        }
    },
    components: { VueMultiselect },
    data () {
        return {
            model: this.value
        }
    },
    watch: {
        model(currentValue) {
            this.$emit('update:modelValue', currentValue)
        }
    },
    methods: {
        customLabel (e) {
            if(e){
                return `${e[this.label]}`
            }else{
                return `Selecione`
            }
        }
    },
    mounted() {

    }
}
</script>
