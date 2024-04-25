<script setup>
import {ref, onMounted, reactive, watch} from 'vue'

const emit = defineEmits(['close', 'submit']);

let props = defineProps({
    show: Boolean,
    title: {
       type: String,
       default: 'Título'
    },
    ButtonClose: {
        type: Boolean,
        default: true
    },
    ButtonSunmit: {
        type: Boolean,
        default: true
    },
    TextButtonClose: {
        type: String,
        default: 'Fechar'
    },
    TextButtonSunmit: {
        type: String,
        default: 'Enviar'
    }
})

const state = reactive({
    modal: null,
})

watch(props, (c) => {
    if(c.show){
        state.modal.show()
    }else{
        state.modal.hide()
    }
});

onMounted(() => {
    state.modal = new bootstrap.Modal(document.getElementById('modal-vue'), {
        keyboard: false
    })
})

function submitModal(){
   state.modal.hide()
   emit('close');
   emit('submit');
}

function closeModal(){
    state.modal.hide()
    emit('close');
}
</script>

<template>
    <!-- Modal -->
    <div class="modal fade" id="modal-vue" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">{{title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" :aria-label="TextButtonClose"></button>
                </div>
                <div class="modal-body">
                    <slot/>
                </div>
                <div class="modal-footer">
                    <button type="button" v-show="ButtonClose" class="btn btn-secondary" @click="closeModal">{{TextButtonClose}}</button>
                    <button type="button" v-show="ButtonSunmit" class="btn btn-primary" @click="submitModal">{{TextButtonSunmit}}</button>
                </div>
            </div>
        </div>
    </div>
</template>
