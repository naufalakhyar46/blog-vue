<template>
	<table class="table table-hover table-border data-table-blog dataTable no-footer">
        <thead>
            <tr>
                <th style="text-align:center" v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    {{column.label}}
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>
<script>
export default {
	props: ['columns', 'sortKey', 'sortOrders']
}
</script>