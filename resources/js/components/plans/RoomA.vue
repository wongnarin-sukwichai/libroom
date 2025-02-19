<template>
    <div class="bg-white rounded-lg mt-10" v-if="!chkHoliday">
        <div
            class="mx-auto max-w-7xl px-6 lg:px-8 border-4 border-dashed border-rose-200 hover:border-rose-300 py-28 text-center hover:text-rose-500 text-4xl cursor-pointer text-rose-400"
        >
            <box-icon
                type="solid"
                name="quote-left"
                class="mr-4"
                color="#f43f5e"
            >
            </box-icon>
            งดให้บริการในวันหยุดนักขัตฤกษ์
            <box-icon
                type="solid"
                name="quote-right"
                class="ml-4"
                color="#f43f5e"
            ></box-icon>
        </div>
    </div>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" v-else>
        <div
            class="box-1 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(1)"
        >
            A-1
        </div>

        <div
            class="box-2 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(2)"
        >
            A-2
        </div>

        <div
            class="box-3 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(3)"
        >
            A-3
        </div>

        <div
            class="box-4 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(4)"
        >
            A-4
        </div>

        <div
            class="box-5 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(5)"
        >
            A-5
        </div>

        <div
            class="box-6 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(6)"
        >
            A-6
        </div>

        <div
            class="box-7 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(7)"
        >
            A-7
        </div>

        <div
            class="box-8 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="chkReserve(8)"
        >
            A-8
        </div>

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
        this.getHoliday();
        this.getContainer();
        this.isWeekend();
        this.getTime();
        this.getRes();
    },
    data() {
        return {
            holiday: false,
            nextHol: false,
            plan: "../img/plans/" + this.$route.params.id + ".png",
            conList: "",
            reserveList: [],
            timeList: "",
        };
    },
    methods: {
        getHoliday() {
            // var d = moment().format("DD");
            // var m = moment().format("MM");
            var day = moment().format("YYYY-MM-DD");
            var next = moment().add(1, "days").format("YYYY-MM-DD");

            var d = moment(day).format("DD");
            var m = moment(day).format("MM");
            var n = moment(next).format("DD");
            var t = moment(next).format("MM");

            axios
                .get("/api/holidayMain/" + d + "/" + m + "/" + n + "/" + t)
                .then((response) => {
                    this.holiday = response.data.res;
                    this.nextHol = response.data.result;
                    // console.log(this.holiday, this.nextHol)
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        isWeekend() {
            //เช็ค เสาร์-อาทิตย์
            var result = new Date();
            if (result.getDay() == 6 || result.getDay() == 0) {
                return (this.weekend = true);
            } else {
                return (this.weekend = false);
            }
        },
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
        getTime() {
            axios
                .get("/api/timeMain")
                .then((response) => {
                    this.timeList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
        getRes() {
            var today = moment().format("YYYY-MM-DD");

            axios
                .get("/api/resPlan/" + today + "/" + this.$route.params.id)
                .then((response) => {
                    this.reserveList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
    },
    computed: {
        chkHoliday() {
            return this.holiday;
        },
        chkNextHol() {
            return this.nextHol;
        },
    },
};
</script>

<style>
.box-1 {
    height: auto;
    position: absolute;
    margin-left: 15%;
    margin-top: 29.5%;
    padding: 1%;
}

.box-2 {
    height: auto;
    position: absolute;
    margin-left: 15%;
    margin-top: 22.5%;
    padding: 1%;
}

.box-3 {
    height: auto;
    position: absolute;
    margin-left: 15%;
    margin-top: 16%;
    padding: 1%;
}

.box-4 {
    height: auto;
    position: absolute;
    margin-left: 15%;
    margin-top: 9.5%;
    padding: 1%;
}

.box-5 {
    height: auto;
    position: absolute;
    margin-left: 44.5%;
    margin-top: 9.5%;
    padding: 1%;
}

.box-6 {
    height: auto;
    position: absolute;
    margin-left: 44.5%;
    margin-top: 16%;
    padding: 1%;
}

.box-7 {
    height: auto;
    position: absolute;
    margin-left: 44.5%;
    margin-top: 22.5%;
    padding: 1%;
}

.box-8 {
    height: auto;
    position: absolute;
    margin-left: 44.5%;
    margin-top: 29.5%;
    padding: 1%;
}

@media only screen and (max-width: 430px) {
    .box-1 {
        height: auto;
        position: absolute;
        margin-left: 8%;
        margin-top: 87.5%;
        padding: 1%;
    }

    .box-2 {
        height: auto;
        position: absolute;
        margin-left: 8%;
        margin-top: 70.5%;
        padding: 1%;
    }

    .box-3 {
        height: auto;
        position: absolute;
        margin-left: 8%;
        margin-top: 54%;
        padding: 1%;
    }

    .box-4 {
        height: auto;
        position: absolute;
        margin-left: 8%;
        margin-top: 37%;
        padding: 1%;
    }

    .box-5 {
        height: auto;
        position: absolute;
        margin-left: 83%;
        margin-top: 37%;
        padding: 1%;
    }

    .box-6 {
        height: auto;
        position: absolute;
        margin-left: 83%;
        margin-top: 54%;
        padding: 1%;
    }

    .box-7 {
        height: auto;
        position: absolute;
        margin-left: 83%;
        margin-top: 70.5%;
        padding: 1%;
    }

    .box-8 {
        height: auto;
        position: absolute;
        margin-left: 83%;
        margin-top: 87.5%;
        padding: 1%;
    }
}
</style>
