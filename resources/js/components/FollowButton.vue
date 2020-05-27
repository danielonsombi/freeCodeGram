<template>
    <div class="container">
        <!--Using v-text Bind the Value of the button to Alternate between the Follow and Unfollow options depending on the current status and profile-->
        <button class="btn btn-primary ml-4" @click="followuser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props:['userId','follows'],


        mounted() {
            console.log('Component mounted.')
        },

        /**
         * The Initial status is optained by passing it from the follow-button reference from the indes.blade file
         * 
         */
        data: function()
        {
            return {
                status:this.follows,
            }
        },

        methods: {
            followuser(){
                axios.post('/follow/' + this.userId) //The user id is passed in from the follow-button in the index view as a property
                .then(response => {

                    this.status = ! this.status; //By Attaching the ! before the Status toggles the current status.
                    console.log(response.data);//Response returns the object. To get the data then use reponse.data
                })
                .catch(errors => {
                    if(errors.response.status == 401) {
                        window.location = '/login';
                    }
                });
            }
        },

        computed:{
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
