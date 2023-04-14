<template>
    <div v-if="this.$props.errors">
        <div v-for="(err, errorsIndex) in this.$props.errors" :key="errorsIndex">
            <div class="" v-if="errorsIndex == this.$props.column">
                <div v-for="(e, errIndex) in err" :key="errIndex">
                    <Alert>
                        <i class="bi bi-info-circle"></i> {{ e }}
                    </Alert>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Alert from '../Layouts/Alert.vue';
export default {
    name: 'ValidationError',
    props: ['errors', 'column'],
    components: {
        Alert
    }
}
</script>