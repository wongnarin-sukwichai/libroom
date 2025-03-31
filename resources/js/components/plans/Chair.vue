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
            class="box-chair border-2 border-dashed border-gray-900 cursor-pointer bg-amber-50 hover:bg-amber-100"
            @click="showModal()"
        >
            Click
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
                            class="card-header text-center text-lg text-blue-700"
                        >
                            {{ roomTitle }}
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
                                width="60%"
                            />
                        </div>

                        <div class="flex card-body justify-center items-center mx-4">
                            <div class="overflow-auto">
                                <table class="border-collapse text-xs ">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th
                                                class="border p-4 font-light"
                                                v-for="(
                                                    n, index
                                                ) in isTime.total"
                                                :key="index"
                                            >
                                                {{ isTime.hour + index
                                                }}{{ isTime.minute }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(room, index) in roomList"
                                            :key="index"
                                        >
                                            <template v-if="room.status === 0">
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
                                                            ) === true
                                                        "
                                                        class="border p-4 text-center cursor-pointer"
                                                        :class="
                                                            chkConfirm(
                                                                room.id,
                                                                index
                                                            ) === 0
                                                                ? 'bg-rose-300'
                                                                : 'bg-green-300'
                                                        "
                                                        @click="
                                                            showReserve(
                                                                room.id,
                                                                index
                                                            )
                                                        "
                                                    ></td>
                                                    <td
                                                        v-else
                                                        class="border p-4 cursor-pointer hover:bg-sky-50"
                                                    ></td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <td
                                                    class="border p-4 bg-rose-300 text-center"
                                                    :colspan="isTime.total"
                                                >
                                                    ** งดให้บริการชั่วคราว **
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

    <!-- Modal Name Reserve -->
    <transition name="fade" mode="out-in">
        <div
            class="relative z-10"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="showModalRes"
        >
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <form
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                        @submit.prevent="cancel()"
                    >
                        <div
                            class="grid grid-cols-2 bg-white px-4 pb-4 sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="user"></box-icon>
                                </div>
                                <div
                                    class="text-center sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ชื่อผู้จอง :
                                    </label>
                                    <div
                                        class="border-dotted border-2 rounded-lg p-2 mb-1"
                                        v-for="(nameRes, index) in this
                                            .nameReserve"
                                        :key="index"
                                    >
                                        {{ nameRes }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:flex sm:items-start"
                                v-if="this.chkStatus === 0"
                            >
                                <div
                                    class="text-center sm:ml-4 sm:text-left w-full"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ยกเลิกการจอง :
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="** ใส่รหัสยกเลิก 4 หลัก **"
                                        required
                                        v-model="dataCancel.code"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <button
                                v-if="this.chkStatus === 0"
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-rose-400 px-3 py-2 text-sm text-white shadow-sm hover:bg-rose-500 sm:ml-3 sm:w-auto"
                            >
                                ยกเลิก
                            </button>
                            <button
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
                                @click="closeReserve()"
                            >
                                ออก
                            </button>
                        </div>
                    </form>
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
        this.isWeekend();
        this.getTime();
        this.getContainer();
        this.getRoom();
        this.getRes();
    },
    data() {
        return {
            holiday: false,
            nextHol: false,
            plan: "../../img/plans/chair.png",
            isModalShow: false,
            showModalRes: false,
            showAlertInput: false,
            showAlertDup: false,
            showAlert: false,
            showAlertRule: false,
            conList: "",
            reserveList: [],
            timeList: "",
            isTime: "",
            conLimit: "",
            weekend: "",
            roomList: "",
            data: {
                date: moment().format("YYYY-MM-DD"),
                loc_id: "",
                con_id: this.$route.params.code,
                room_id: this.$route.params.id,
                time: [],
                uid: [],
                name: [],
                surname: [],
                type: [],
                faculty: [],
                branch: [],
                rule: [],
                code: "",
                status: "",
            },
            dataCancel: {
                id: "",
                time: "",
                code: "",
                today: moment().format("YYYY-MM-DD"),
            },
            roomTitle: "",
            nameReserve: [],
            chkStatus: "",
            chkLength: ""
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
                .get("/api/showPlan/" + this.$route.params.code)
                .then((response) => {
                    this.conList = response.data;
                    this.conLimit = response.data.limited;

                    if (this.weekend == false) {
                        this.isTime = this.setTimer(response.data.time_1);
                    } else {
                        this.isTime = this.setTimer(response.data.time_2);
                    }
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
        getRoom() {
            axios
                .get("/api/roomID/" + this.$route.params.id)
                .then((response) => {
                    this.roomList = response.data;

                    this.data.loc_id = this.roomList[0].loc_id;
                    this.data.status = this.roomList[0].kind;
                    this.roomTitle = this.roomList[0].title;
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
                .get("/api/resRoom/" + today + "/" + this.$route.params.id)
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
        async showModal() {
            this.isModalShow = true;
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
                (this.data.code = ""),
                (this.data.status = "");
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
        async chkMem(limit) {
            this.showAlertInput = false;
            this.chkRule == "";

            if (limit != this.data.uid.length) {
                this.showAlertInput = true;
            } else if (this.checkDup(this.data.uid) == false) {
                this.showAlertDup = true;
                // console.log(this.checkDup(this.data.uid));
            } else {
                this.showAlertInput = false;
                this.showAlertDup = false;
                var today = moment().format("YYYY-MM-DD");

                for (var i = 0; i < this.data.uid.length; i++) {
                    if (this.data.uid[i] == "") {
                        this.showAlertInput = true;
                    } else {
                        await axios
                            .get("/api/member/" + this.data.uid[i])
                            .then((response) => {
                                if (response.data == "false") {
                                    const token = "{token}";
                                    const config = {
                                        headers: {
                                            // Accept: "application/x-www-form-urlencode; charset=UTF-8",
                                            Authorization: "Bearer " + token,
                                        },
                                    };
                                    axios
                                        .get(
                                            "https://liboffice.msu.ac.th/api/getPatron/" +
                                                this.data.uid[i],
                                            config
                                        )
                                        // .get(
                                        //     "https://library.msu.ac.th/libapi/api/apitest",
                                        //     config
                                        // )
                                        .then((response) => {
                                            // console.log(response);
                                            axios
                                                .post(
                                                    "/api/member",
                                                    response.data
                                                )
                                                .then((result) => {
                                                    this.data.name[i - 1] =
                                                        result.data.name;
                                                    this.data.surname[i - 1] =
                                                        result.data.surname;
                                                    this.data.type[i - 1] =
                                                        result.data.type;
                                                    this.data.faculty[i - 1] =
                                                        result.data.faculty;
                                                    this.data.branch[i - 1] =
                                                        result.data.branch;
                                                    // console.log(this.data);
                                                })
                                                .catch((err) => {
                                                    // console.log(err);
                                                });
                                            // this.data.name[i] = response.data[0].FNAMETHAI;
                                            // this.data.surname[i] = response.data[0].LNAMETHAI;
                                            // console.log(this.data.name);
                                        })
                                        .catch((err) => {
                                            // console.log(err);
                                            Swal.fire({
                                                icon: "error",
                                                title: "ไม่พบข้อมูลสมาชิก",
                                                text: "กรุณาติดต่อเจ้าหน้าที่",
                                            });
                                        });
                                } else {
                                    this.data.name[i] = response.data.name;
                                    this.data.surname[i] =
                                        response.data.surname;
                                    this.data.type[i] = response.data.type;
                                    this.data.faculty[i] =
                                        response.data.faculty;
                                    this.data.branch[i] = response.data.branch;
                                }
                                axios
                                    .get(
                                        "/api/checkReserve/" +
                                            today +
                                            "/" +
                                            this.data.uid[i]
                                    )
                                    .then((response) => {
                                        this.data.rule[i - 1] = response.data;
                                        if (
                                            this.chkRule > response.data ||
                                            this.chkRule == ""
                                        ) {
                                            this.chkRule = response.data;
                                        }
                                    })
                                    .catch((err) => {
                                        // console.log(err);
                                    });
                            })
                            .catch((err) => {
                                Swal.fire({
                                    icon: "error",
                                    title: "ไม่พบข้อมูลสมาชิก",
                                    text: "กรุณาติดต่อเจ้าหน้าที่",
                                });
                            });
                    }
                }
            }
            this.getRes();
        },
        checkDup(arr) {
            var res = arr.filter((item, index) => arr.indexOf(item) !== index);
            if (res == "") {
                return true;
            } else {
                return false;
            }
        },
        async send() {
            if (this.data.uid.length != this.conLimit) {
                Swal.fire({
                    title: "ผิดพลาด",
                    text: "กรุณากรอกข้อมูลให้ครบและตรวจสอบข้อมูล",
                    icon: "error",
                });
            } else if (this.data.time.length > this.chkRule) {
                Swal.fire({
                    title: "ผิดพลาด",
                    text: "ใช้บริการต่อคนได้ไม่เกินสิทธิ์คงเหลือ",
                    icon: "error",
                });
            } else if (this.data.time.length < 1) {
                Swal.fire({
                    title: "ผิดพลาด",
                    text: "กรุณาเลือกเวลา",
                    icon: "error",
                });
            } else if (this.data.time.length > 3) {
                Swal.fire({
                    title: "ผิดพลาด",
                    text: "ใช้บริการได้ไม่เกิน 3 ชั่วโมง/วัน",
                    icon: "error",
                });
            } else {
                // if (this.type == true) {
                //     this.data.date = moment()
                //         .add("1", "days")
                //         .format("YYYY-MM-DD");
                // } else {
                //     this.data.date = moment().format("YYYY-MM-DD");
                // }

                let timerInterval;
                await Swal.fire({
                    title: "กำลังตรวจสอบ...",
                    html: "กรุณารอ... <b></b>",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    },
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // console.log("I was closed by the timer");
                    }
                });

                if (this.data.name == null) {
                    Swal.fire({
                        title: "ผิดพลาด",
                        text: "ไม่พบข้อมูลสมาชิก กรุณาติดต่อเจ้าหน้าที่",
                        icon: "error",
                    });
                } else {
                    // console.log(this.data.name);
                    try {
                        this.data.code = await this.getCode();
                        await axios
                            .post("/api/addReserve", this.data)
                            .then((response) => {
                                this.clearArr();

                                this.chkRule = "";
                                this.isModalShow = false;

                                this.getRes();

                                Swal.fire({
                                    icon: response.data.icon,
                                    title: response.data.title,
                                    text: response.data.text,
                                });
                            });
                    } catch (err) {
                        // console.log(err);
                        Swal.fire({
                            title: "ผิดพลาด",
                            text: "ไม่พบข้อมูลสมาชิก กรุณาติดต่อเจ้าหน้าที่",
                            icon: "error",
                        });
                    }
                }
            }
        },
        getCode() {
            return Math.floor(Math.random() * 9000 + 1000);
        },
        close() {
            this.clearArr();
            this.isModalShow = false;
        },
        showReserve(id, time) {
            if (id != null && time != null) {
                var res = this.reserveList.filter(
                    (selection) =>
                        selection["room_id"] == id && selection["time"] == time
                );

                for (var i = 0; i < res.length; i++) {
                    this.nameReserve[i] = res[i].name + " " + res[i].surname;
                    this.chkStatus = res[i].status;
                }

                this.showModalRes = true;
                this.dataCancel.id = id;
                this.dataCancel.time = time;
            }
        },
        closeReserve() {
            this.chkStatus = "";
            this.showModalRes = false;
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
.box-chair {
    height: auto;
    position: absolute;
    margin-left: 30%;
    margin-top: 15%;
    padding: 1%;
}

@media (max-width: 430px) {
    .box-chair {
        height: auto;
        position: absolute;
        margin-left: 45%;
        margin-top: 50%;
        padding: 1%;
    }
}

@media (max-width: 820px) {
    .box-chair {
        height: auto;
        position: absolute;
        margin-left: 44%;
        margin-top: 30%;
        padding: 1%;
    }
}
</style>
