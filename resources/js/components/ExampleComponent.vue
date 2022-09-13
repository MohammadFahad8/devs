<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                      {{message}}  I am a vuew Component
                    </div>
                    <CarComponent :count="message" v-on:childMessage="childMessage"></CarComponent>
                    <button  class="btn btn-success btn-sm form-control-lg" v-on:click="countIncrease">increase</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CarComponent from './CarComponent.vue'
    export default {
    mounted() {
        console.log("Component mounted.");
    },
    data() {
        return {
            message: 1
        };
    },
    methods: {
        countIncrease: function () {
            this.message += 1;
        },
        childMessage:function(payload)
        {
            this.message=payload
        }
    },
    watch: {
        message: function () {
            console.log("Do something whenever value of message changes");
        }
    },
    components: { CarComponent }
}
</script>
