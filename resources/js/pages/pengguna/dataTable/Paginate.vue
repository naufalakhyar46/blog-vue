<template>
	<div v-if="!client" class="row" >
        <div class="col-sm-5">
            <br>
            <div class="dataTables_info">
                {{pagination.from}} - {{pagination.to}} of {{pagination.total}}
            </div>
        </div>
        <div class="col-sm-7">
            <ul align="right" class="pagination">
                <li v-if="pagination.prevPageUrl" class="paginate_button previous ">
                    <a  @click="$emit('prev');">
                        Prev
                    </a>
                </li>
                <li v-else class="paginate_button previous disabled">
                    <a disabled>
                    Prev
                    </a>
                </li>
                <li v-if="pagination.nextPageUrl" class="paginate_button next ">
                    <a  class="button is-small pagination-next" @click="$emit('next');">
                        Next
                    </a>
                </li>
                <li v-else class="paginate_button next disabled">
                    <a disabled>
                        Next
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <nav class="pagination" v-else>
        <span class="page-stats">
            {{pagination.from}} - {{pagination.to}} of {{filtered.length}}
            <span v-if="filtered.length < pagination.total">(filtered from {{pagination.total}} total entries)</span>
        </span>
        <a v-if="pagination.prevPage" class="button is-small pagination-previous" @click="$emit('prev');">
            Prev
        </a>
        <a class="button is-small pagination-previous" v-else :disabled="true">
           Prev
        </a>

        <a v-if="pagination.nextPage" class="button is-small pagination-next" @click="$emit('next');">
            Next
        </a>
        <a class="button is-small pagination-next" v-else :disabled="true">
            Next
        </a>
    </nav>
</template>
<script>
export default {
	props: ['pagination', 'client', 'filtered']
}
</script>