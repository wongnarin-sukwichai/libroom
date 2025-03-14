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
                            class="card-header text-center text-md text-gray-500"
                        >
                            ( {{ conList.detail }} )
                        </div>
                        <div class="flex card-body justify-center items-center">
                            <img
                                :src="plan"
                                class="object-cover object-center"
                                width="10%"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-10 gap-4">
                        <div
                            class="border-2 border-dashed border-gray-900 cursor-pointer bg-amber-50 hover:bg-amber-100 mt-8 p-4 text-center"
                            v-for="(room, index) in roomList"
                            :key="index"
                            @click="goRoom(room.con_id, room.id)"
                        >
                            {{ room.id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "boxicons";
import Swal from "sweetalert2";
import moment from "moment"; //format date thai
import "moment/dist/locale/th";
import axios from "axios";
moment.locale("th");

export default {
    mounted() {
        this.getContainer();
        this.getRoom();
    },
    data() {
        return {
            plan: "../../img/plans/chair.png",
            conList: "",
            roomList: "",
        };
    },
    methods: {
        getContainer() {
            axios
                .get("/api/showPlan/" + this.$route.params.id)
                .then((response) => {
                    this.conList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
        getRoom() {
            axios
                .get("/api/roomMain/" + this.$route.params.id)
                .then((response) => {
                    this.roomList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
        goRoom(code, id) {

            this.$router.push("/chair/" + code + "/" + id);
        },
    },
};
</script>
