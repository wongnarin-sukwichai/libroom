<template>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div
                            class="card-header text-center text-2xl text-gray-800"
                        >
                            {{ conList.title }}
                        </div>
                        <div
                            class="card-header text-center text-lg text-gray-500 my-6"
                        >
                            ( {{ conList.detail }} )
                        </div>
                        <div class="flex card-body justify-center items-center">
                            <img
                                :src="plan"
                                class="object-cover object-center"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="box"></div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    mounted() {
        this.getContainer();
    },
    data() {
        return {
            plan: "../img/plans/" + this.$route.params.id + ".png",
            conList: "",
        };
    },
    methods: {
        getContainer() {
            axios
                .get("/api/showPlan/" + this.$route.params.id)
                .then((response) => {
                    this.conList = response.data;
                    console.log(this.conList);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
