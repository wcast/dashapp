<template>
    <div>
        <button
            :disabled="pageNumber === 0"
            @click="prevPage">
            Previous
        </button>
        <button
            :disabled="pageNumber >= pageCount -1"
            @click="nextPage">
            Next
        </button>
    </div>
</template>

<script>
import {defineComponent, defineEmits} from "vue";

const emit = defineEmits(['data_list']);

export default defineComponent({
    name: 'PaginationLocal',
    data() {
        return {
            pageNumber: 0
        }
    },
    props: {
        listData: {
            type: Array,
            required: true
        },
        size: {
            type: Number,
            required: false,
            default: 10
        }
    },
    methods: {
        nextPage() {
            this.pageNumber++;
        },
        prevPage() {
            this.pageNumber--;
        }
    },
    computed: {
        pageCount() {
            let l = this.listData.length, s = this.size;
            return Math.ceil(l / s);
        },
        paginatedData() {
            const start = this.pageNumber * this.size, end = start + this.size;
            emit('data-result', this.listData.slice(start, end))
        }
    }
});
</script>
