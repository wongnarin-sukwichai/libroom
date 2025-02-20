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
            @click="
                showModal(1, 'A-1', this.conList.time_1, this.conList.time_2)
            "
        >
            A-1
        </div>

        <div
            class="box-2 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(2, 'A-2', this.conList.time_1, this.conList.time_2)
            "
        >
            A-2
        </div>

        <div
            class="box-3 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(3, 'A-3', this.conList.time_1, this.conList.time_2)
            "
        >
            A-3
        </div>

        <div
            class="box-4 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(4, 'A-4', this.conList.time_1, this.conList.time_2)
            "
        >
            A-4
        </div>

        <div
            class="box-5 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(5, 'A-5', this.conList.time_1, this.conList.time_2)
            "
        >
            A-5
        </div>

        <div
            class="box-6 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(6, 'A-6', this.conList.time_1, this.conList.time_2)
            "
        >
            A-6
        </div>

        <div
            class="box-7 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(7, 'A-7', this.conList.time_1, this.conList.time_2)
            "
        >
            A-7
        </div>

        <div
            class="box-8 border-2 border-dashed border-gray-900 cursor-pointer font-bold bg-amber-50 hover:bg-amber-100"
            @click="
                showModal(8, 'A-8', this.conList.time_1, this.conList.time_2)
            "
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

    <!-- Modal Show -->
    <transition name="fade" mode="out-in">
        <div
            class="relative z-10"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="isModalShow"
        >
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl"
                    >
                        <!-- sm:max-w-xl ปรับความกว้าง modal -->
                        <br />
                        <div
                            class="grid grid-cols-5 bg-white px-4"
                            v-for="(lim, index) in this.conLimit"
                            :key="index"
                        >
                            <div class="col-span-3 sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="user"></box-icon>
                                </div>
                                <div
                                    class="mt-0 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        รหัสนิสิต :</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        required
                                        v-model="data.uid[index]"
                                    />
                                </div>
                            </div>

                            <div
                                class="col-span-2 flex items-left justify-left mx-5 py-5"
                            >
                                <div
                                    class="border-dotted border-2 border-sky-500 rounded-lg p-3 text-xs"
                                >
                                    {{ this.data.name[index] }} : เหลือ
                                    {{ this.data.rule[index] }} สิทธิ์
                                </div>
                            </div>
                        </div>

                        <transition name="fade" mode="out-in">
                            <div
                                class="text-rose-500 mx-20"
                                v-show="showAlertInput"
                            >
                                ** กรุณากรอกข้อมูลให้ครบ
                            </div>
                        </transition>
                        <transition name="fade" mode="out-in">
                            <div
                                class="text-rose-500 mx-20"
                                v-show="showAlertDup"
                            >
                                ** รหัสห้ามซ้ำ
                            </div>
                        </transition>

                        <div class="bg-white px-4 pb-4 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="check"></box-icon>
                                </div>
                                <div
                                    class="text-center sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ตรวจสอบรหัสและสิทธิ์ :
                                    </label>

                                    <div class="text-center w-full pt-2">
                                        <label
                                            id="listbox-label"
                                            class="text-sm font-medium leading-6 text-gray-900"
                                        >
                                        </label>
                                        <button
                                            class="block w-full items-center justify-center p-4 px-6 py-2 font-medium border-2 border-green-400 rounded-full shadow-md group text-gray-400 hover:text-black hover:bg-green-200"
                                            @click="chkMem(this.conLimit)"
                                        >
                                            <span
                                                class="flex items-center justify-center w-full h-full text-xs"
                                                >ตรวจสอบ</span
                                            >
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                ></div>
                            </div>
                        </div>

                        <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="time"></box-icon>
                                </div>
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                    >
                                        จองเวลา :</label
                                    >
                                    <div
                                        class="grid grid-cols-4 p-3 border rounded-lg"
                                    >
                                        <label
                                            v-for="(n, index) in isTime.total"
                                            :key="index"
                                        >
                                            <input
                                                v-if="
                                                    chkReserve(
                                                        this.data.room_id,
                                                        index
                                                    ) === true
                                                "
                                                type="checkbox"
                                                class="mr-1"
                                                disabled
                                            />
                                            <input
                                                v-else
                                                type="checkbox"
                                                class="mr-1 cursor-pointer"
                                                :value="index"
                                                v-model="data.time"
                                            />
                                            {{ isTime.hour + index
                                            }}{{ isTime.minute }}
                                        </label>
                                    </div>
                                    <div>{{ chkLength }}</div>
                                    <transition name="fade" mode="out-in">
                                        <div
                                            class="pt-2 text-rose-500"
                                            v-show="showAlert"
                                        >
                                            ** ใช้บริการได้ไม่เกิน 3 ชั่วโมง/วัน
                                        </div>
                                    </transition>
                                    <transition name="fade" mode="out-in">
                                        <div
                                            class="pt-2 text-rose-500"
                                            v-show="showAlertRule"
                                        >
                                            **
                                            ใช้บริการต่อคนได้ไม่เกินสิทธิ์คงเหลือ
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 pb-4 sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="table"></box-icon>
                                </div>
                                <div
                                    class="text-center sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ตารางเวลา :
                                    </label>

                                    <div class="text-center w-full pt-2">
                                        <div class="overflow-auto">
                                            <table
                                                class="border-collapse text-xs"
                                            >
                                                <thead>
                                                    <tr class="bg-gray-100">
                                                        <th
                                                            class="border p-1 font-light"
                                                            v-for="(
                                                                n, index
                                                            ) in isTime.total"
                                                            :key="index"
                                                        >
                                                            {{
                                                                isTime.hour +
                                                                index
                                                            }}{{
                                                                isTime.minute
                                                            }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            room, index
                                                        ) in roomList"
                                                        :key="index"
                                                    >
                                                        <template
                                                            v-if="
                                                                room.status ===
                                                                0
                                                            "
                                                        >
                                                            <template
                                                                v-for="(
                                                                    n, index
                                                                ) in isTime.total"
                                                                :key="index"
                                                            >
                                                                <td
                                                                    v-if="
                                                                        chkReserve(
                                                                            room.id,
                                                                            index
                                                                        ) ===
                                                                        true
                                                                    "
                                                                    class="border p-4 text-center"
                                                                    :class="
                                                                        chkConfirm(
                                                                            room.id,
                                                                            index
                                                                        ) === 0
                                                                            ? 'bg-rose-300'
                                                                            : 'bg-green-300'
                                                                    "                                                               
                                                                ></td>
                                                                <td
                                                                    v-else
                                                                    class="border p-4"                                                              
                                                                ></td>
                                                            </template>
                                                        </template>
                                                        <template v-else>
                                                            <td
                                                                class="border p-4 bg-rose-300 text-center"
                                                                :colspan="
                                                                    isTime.total
                                                                "
                                                            >
                                                                **
                                                                งดให้บริการชั่วคราว
                                                                **
                                                            </td>
                                                        </template>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                ></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 pt-3">
                            <div
                                class="grid grid-cols-2 px-4 py-4 sm:px-6 bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100"
                            >
                                <div class="justify-start text-sm">
                                    {{ this.roomTitle }}
                                </div>
                                <div class="flex justify-end text-sm">
                                    จำนวนผู้ใช้
                                    <span class="pl-1 pr-1">{{
                                        this.conList.limited
                                    }}</span>
                                    คน
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                            >
                                <button
                                    class="inline-flex w-full justify-center rounded-md bg-green-500 px-3 py-2 text-sm text-white shadow-sm hover:bg-green-600 sm:ml-3 sm:w-auto"
                                    @click="send()"
                                >
                                    บันทึก
                                </button>
                                <button
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
                                    @click="close()"
                                >
                                    ออก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
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
            isModalShow: false,
            conList: "",
            reserveList: [],
            timeList: "",
            isTime: "",
            conLimit: "",
            roomTitle: "",
            weekend: "",
            roomList: "",
            data: {
                date: moment().format("YYYY-MM-DD"),
                loc_id: "",
                con_id: "",
                room_id: "",
                time: [],
                uid: [],
                name: [],
                surname: [],
                type: [],
                faculty: [],
                branch: [],
                rule: [],
                code: "",
            },
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
                    this.conLimit = response.data.limited;
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
        chkReserve(id, code) {
            var res = this.reserveList.some(
                (selection) =>
                    selection["room_id"] == id && selection["time"] == code
            );
            return res;
        },

        setTimer(id) {
            //ดึงวัน time table
            var result;
            this.timeList.forEach((showTime) => {
                if (showTime.id == id) {
                    result = showTime;
                }
            });
            return result;
        },
        async showModal(id, code, time_1, time_2) {
            this.clearArr();

            if (this.weekend == false) {
                this.isTime = this.setTimer(time_1);
            } else {
                this.isTime = this.setTimer(time_2);
            }

            await axios
                .get("/api/roomID/" + id)
                .then((response) => {
                    this.roomList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });

            this.isModalShow = true;
            this.data.room_id = id;
            this.roomTitle = code;

        },
        close() {
            this.clearArr();
            this.isModalShow = false;
        },
        clearArr() {
            (this.data.time = []),
                (this.data.uid = []),
                (this.data.name = []),
                (this.data.surname = []),
                (this.data.type = []),
                (this.data.faculty = []),
                (this.data.branch = []),
                (this.data.rule = []),
                (this.data.code = "");
        },
        chkConfirm(id, code) {
            if (id != null && code != null) {
                var res = this.reserveList.find(
                    (selection) =>
                        selection["room_id"] == id && selection["time"] == code
                );
                return res.status;
            }
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
