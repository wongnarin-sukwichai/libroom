<template>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <img :src="banner" class="p-2 shadow-lg" />
    </div>

    <div class="bg-white rounded-lg">
        <a href="/pdf/tools.pdf" target="_blank">
            <div
                class="px-6 py-4 mx-auto text-center border-2 border-dashed cursor-pointer max-w-7xl lg:px-8 border-rose-200 hover:border-rose-300 hover:text-rose-500 lg:text-2xl sm:text-lg text-rose-400"
            >
                กรุณาศึกษา "คู่มือการใช้งานระบบ"

                <box-icon
                    type="solid"
                    name="hand-up"
                    color="pink"
                    animation="fade-up"
                ></box-icon>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-lg" v-if="!chkHoliday">
        <div
            class="px-6 mx-auto text-4xl text-center border-4 border-dashed cursor-pointer max-w-7xl lg:px-8 border-rose-200 hover:border-rose-300 py-28 hover:text-rose-500 text-rose-400"
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

    <div class="bg-white rounded-lg" v-else>
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <!-- Location -->
            <div
                class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"
                ref="locSection"
            >
                <div class="max-w-2xl mx-auto lg:max-w-none">
                    <div
                        class="mt-6 space-y-12 lg:grid lg:grid-cols-2 lg:gap-x-6 lg:space-y-0"
                    >
                        <div
                            class="relative group"
                            v-for="(loc, index) in locList"
                            :key="index"
                        >
                            <div
                                class="relative w-full overflow-hidden rounded-lg h-80 sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 sm:h-64 hover:opacity-75"
                                @click="pickLoc(loc.id)"
                                :class="
                                    locActive === loc.id
                                        ? 'ring-2 ring-offset-2'
                                        : locGray === true
                                        ? 'grayscale-0'
                                        : 'grayscale'
                                "
                            >
                                <img
                                    :src="locPath + loc.pic"
                                    class="object-cover object-center w-full h-full cursor-pointer"
                                />
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                {{ loc.eng }}
                            </h3>
                            <p
                                class="mb-6 text-base font-semibold text-gray-900"
                            >
                                {{ loc.title }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arec Room -->
            <transition name="fade" mode="out-in">
                <div class="bg-white" ref="arecSection">
                    <div
                        class="max-w-2xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8"
                    >
                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                        >
                            <div
                                class="group"
                                v-for="(con, index) in showContainer"
                                :key="index"
                            >
                                <div
                                    class="w-full overflow-hidden rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7"
                                    @click="
                                        pickCon(
                                            con.id,
                                            con.limited,
                                            con.time_1,
                                            con.time_2
                                        )
                                    "
                                    :class="
                                        conActive === con.id
                                            ? 'ring-2 ring-offset-2'
                                            : conGray === true
                                            ? 'grayscale-0'
                                            : 'grayscale'
                                    "
                                >
                                    <img
                                        :src="conPath + con.pic"
                                        class="object-cover object-center w-full h-full cursor-pointer group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-gray-700 text-md">
                                    {{ con.title }}
                                </h3>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ con.detail }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Table -->
            <transition name="fade" mode="out-in">
                <div class="overflow-auto" v-if="tableList" ref="tableSection">
                    <table class="border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <!-- <th class="p-4 border">#</th> -->
                                <th class="w-48 p-4 border">รายละเอียด</th>
                                <th
                                    class="p-4 border"
                                    v-for="(n, index) in isTime.total"
                                    :key="index"
                                >
                                    {{ isTime.hour + index }}{{ isTime.minute }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(room, index) in roomList" :key="index">
                                <!--<td class="border">
                                    <img
                                        :src="roomPath + room.pic"
                                        class="w-16 h-16"
                                    />
                                </td>-->
                                <td class="p-4 text-center border">
                                    {{ room.title }}
                                </td>
                                <template v-if="room.status === 0">
                                    <template
                                        v-for="(n, index) in isTime.total"
                                        :key="index"
                                    >
                                        <td
                                            v-if="
                                                chkReserve(room.id, index) ===
                                                true
                                            "
                                            class="p-4 text-center border cursor-pointer"
                                            :class="
                                                chkConfirm(room.id, index) === 0
                                                    ? 'bg-rose-300'
                                                    : 'bg-green-300'
                                            "
                                            @click="
                                                showReserve(
                                                    room.id,
                                                    index,
                                                    room.con_id
                                                )
                                            "
                                        ></td>
                                        <td
                                            v-else
                                            class="p-4 border cursor-pointer hover:bg-sky-50"
                                            @click="
                                                showModal(
                                                    room.id,
                                                    room.title,
                                                    room.kind
                                                )
                                            "
                                        ></td>
                                    </template>
                                </template>
                                <template v-else>
                                    <td
                                        class="p-4 text-center border bg-rose-300"
                                        :colspan="isTime.total"
                                    >
                                        ** งดให้บริการชั่วคราว **
                                    </td>
                                </template>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </transition>
        </div>

        <!-- <transition name="fade" mode="out-in">
            <div
                v-if="cookieModal"
                id="cookie-banner"
                class="bg-black cookie-banner text-gray-50"
            >
                เว็บไซต์นี้มีการใช้งานคุกกี้เพื่อให้ท่านสามารถใช้บริการได้อย่างต่อเนื่องและอำนวยความสะดวกในการใช้งานเว็บไซต์
                รวมถึงช่วยให้เราปรับปรุงการนำเสนอเนื้อหาตรงตามความต้องการของท่าน
                โดยสามารถศึกษารายละเอียดเพิ่มเติมได้ใน
                <a
                    href="https://pdpa.msu.ac.th/cookie-policy/"
                    target="_blank"
                    class="underline text-sky-300 hover:text-sky-500"
                    >นโยบายการใช้คุกกี้</a
                >
                <button
                    @click="closeCookie()"
                    class="bg-yellow-400 cursor-pointer cookie-button hover:bg-yellow-500"
                >
                    ยอมรับ
                </button>
            </div>
        </transition> -->
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
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0"
                >
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg"
                    >
                        <br />
                        <div
                            class="grid grid-cols-5 px-4 bg-white"
                            v-for="(lim, index) in this.conLimit"
                            :key="index"
                        >
                            <div class="col-span-3 sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="user"></box-icon>
                                </div>
                                <div
                                    class="w-full mt-0 text-center sm:mt-0 sm:ml-4 sm:text-left"
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
                                class="flex col-span-2 py-5 mx-5 items-left justify-left"
                            >
                                <div
                                    class="p-3 text-xs border-2 border-dotted rounded-lg border-sky-500"
                                >
                                    {{ this.data.name[index] }} : เหลือ
                                    {{ this.data.rule[index] }} สิทธิ์
                                </div>
                            </div>
                        </div>

                        <transition name="fade" mode="out-in">
                            <div
                                class="mx-20 text-rose-500"
                                v-show="showAlertInput"
                            >
                                ** กรุณากรอกข้อมูลให้ครบ
                            </div>
                        </transition>
                        <transition name="fade" mode="out-in">
                            <div
                                class="mx-20 text-rose-500"
                                v-show="showAlertDup"
                            >
                                ** รหัสห้ามซ้ำ
                            </div>
                        </transition>

                        <div class="px-4 pb-4 bg-white sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="check"></box-icon>
                                </div>
                                <div
                                    class="w-full text-center sm:ml-4 sm:text-left"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ตรวจสอบรหัสและสิทธิ์ :
                                    </label>

                                    <div class="w-full pt-2 text-center">
                                        <label
                                            id="listbox-label"
                                            class="text-sm font-medium leading-6 text-gray-900"
                                        >
                                        </label>
                                        <button
                                            class="items-center justify-center block w-full p-4 px-6 py-2 font-medium text-gray-400 border-2 border-green-400 rounded-full shadow-md group hover:text-black hover:bg-green-200"
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
                                    class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                                ></div>
                            </div>
                        </div>

                        <div class="px-4 pt-5 bg-white sm:p-4 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="time"></box-icon>
                                </div>
                                <div
                                    class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
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

                        <!-- <div
                            class="grid grid-cols-2 px-4 pb-4 bg-white sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="calendar"></box-icon>
                                </div>
                                <div
                                    class="w-full text-center sm:ml-4 sm:text-left"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >จองข้ามวัน :
                                    </label>
                                    <div
                                        class="p-4 border rounded-lg"
                                        v-if="chkNextHol"
                                    >
                                        <label>
                                            <input
                                                type="checkbox"
                                                class="mr-1 cursor-pointer"
                                                v-model="type"
                                            />
                                            วันพรุ่งนี้
                                        </label>
                                    </div>
                                    <div class="p-4 border rounded-lg" v-else>
                                        <label
                                            class="flex items-center justify-center"
                                        >
                                            <box-icon
                                                name="x"
                                                color="#f87171"
                                                class="mr-1"
                                            ></box-icon>
                                            <span class="text-sm"
                                                >พรุ่งนี้งดให้บริการ</span
                                            >
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:flex sm:items-start">
                                <div
                                    class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                                ></div>
                            </div>
                        </div> -->

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
                                        this.conLimit
                                    }}</span>
                                    คน
                                </div>
                            </div>
                            <div
                                class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6"
                            >
                                <button
                                    class="inline-flex justify-center w-full px-3 py-2 text-sm text-white bg-green-500 rounded-md shadow-sm hover:bg-green-600 sm:ml-3 sm:w-auto"
                                    @click="send()"
                                >
                                    บันทึก
                                </button>
                                <button
                                    type="button"
                                    class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm text-gray-900 bg-white rounded-md shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
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
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0"
                >
                    <form
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg"
                        @submit.prevent="cancel()"
                    >
                        <div
                            class="grid grid-cols-2 px-4 pb-4 bg-white sm:p-4 sm:pb-4"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-lime-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    <box-icon name="user"></box-icon>
                                </div>
                                <div
                                    class="w-full text-center sm:ml-4 sm:text-left"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ชื่อผู้จอง :
                                    </label>
                                    <div
                                        class="p-2 mb-1 border-2 border-dotted rounded-lg"
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
                                    class="w-full text-center sm:ml-4 sm:text-left"
                                >
                                    <label
                                        id="listbox-label"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >ยกเลิกการจอง :
                                    </label>
                                    <input
                                        type="text"
                                        class="block w-full px-3 py-2 m-0 text-base font-normal text-gray-700 transition ease-in-out bg-white border border-gray-300 border-solid rounded form-control bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="** ใส่รหัสยกเลิก 4 หลัก **"
                                        required
                                        v-model="dataCancel.code"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <button
                                v-if="this.chkStatus === 0"
                                type="submit"
                                class="inline-flex justify-center w-full px-3 py-2 text-sm text-white rounded-md shadow-sm bg-rose-400 hover:bg-rose-500 sm:ml-3 sm:w-auto"
                            >
                                ยกเลิก
                            </button>
                            <button
                                type="button"
                                class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm text-gray-900 bg-white rounded-md shadow-sm hover:bg-gray-50 ring-1 ring-inset ring-gray-300 sm:mt-0 sm:w-auto"
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

    <!-- Back to Location Button -->
    <transition name="fade" mode="out-in">
        <button
            v-if="locActive !== ''"
            @click="scrollToLoc()"
            type="button"
            title="กลับไปเลือกสถานที่"
            class="fixed z-50 flex items-center justify-center w-12 h-12 text-white transition rounded-full shadow-lg bottom-6 right-6 bg-sky-500 hover:bg-sky-600"
        >
            <box-icon name="chevron-up" color="white"></box-icon>
        </button>
    </transition>

    <!-- Announcement Banner Modal -->
    <transition name="fade">
        <div
            v-if="showBannerModal"
            @click.self="closeBannerModal()"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 p-4"
        >
            <div class="relative w-full max-w-3xl lg:max-w-5xl xl:max-w-6xl">
                <button
                    @click="closeBannerModal()"
                    type="button"
                    title="ปิด"
                    class="absolute flex items-center justify-center w-10 h-10 text-gray-700 transition bg-white rounded-full shadow-lg -top-3 -right-3 hover:bg-gray-100"
                >
                    <box-icon name="x"></box-icon>
                </button>
                <img
                    :src="bannerModal"
                    class="max-h-[85vh] lg:max-h-[92vh] w-full rounded-lg object-contain shadow-2xl"
                />
            </div>
        </div>
    </transition>
</template>

<script>
// import "boxicons";
import Swal from "sweetalert2";
import moment from "moment"; //format date thai
import "moment/dist/locale/th";
import axios from "axios";
moment.locale("th");

export default {
    async mounted() {
        await this.getHoliday();
        await this.getLocation();
        await this.getContainer();
        await this.isWeekend();
        await this.getTime();
        await this.getReserve();
    },
    data() {
        return {
            holiday: false,
            nextHol: false,
            isModalShow: false,
            showAlert: false,
            showAlertRule: false,
            showModalRes: false,
            showAlertInput: false,
            showAlertDup: false,
            banner: "img/banner.jpg",
            locPath: "img/locations/",
            conPath: "img/containers/",
            /**roomPath: "img/rooms/",*/
            tableList: false,
            locList: "",
            conList: "",
            showContainer: "",
            locActive: "", //กดคลิ๊กขึ้นกรอบน้ำเงิน
            locGray: true, //ภาพ gray scale
            conActive: "",
            conGray: true,
            conLimit: "",
            conTime1: "",
            conTime2: "",
            roomList: "",
            timeList: "",
            // recordList: "",
            reserveList: [],
            weekend: "",
            isTime: "",
            moment: moment,
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
                status: "",
            },
            type: false,
            active: false,
            dataCancel: {
                id: "",
                time: "",
                code: "",
                today: moment().format("YYYY-MM-DD"),
            },
            roomTitle: "",
            nameReserve: [],
            chkStatus: "",
            chkRule: "",
            cookieModal: true,
            showBannerModal: true,
            bannerModal: "img/banner/banner.png",
        };
    },
    methods: {
        closeBannerModal() {
            this.showBannerModal = false;
        },
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
        getLocation() {
            axios
                .get("/api/locMain")
                .then((response) => {
                    this.locList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });
        },
        getContainer() {
            axios
                .get("/api/conMain")
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
        pickLoc(id) {
            this.tableList = false;
            let arr = [];
            let i = 0;
            this.conList.forEach((showCon) => {
                if (showCon.loc_id === id) {
                    arr[i] = showCon;
                    i++;
                }
            });
            this.showContainer = arr;
            this.locActive = id;
            this.locGray = false;
            this.conGray = true;
            this.data.loc_id = id;

            this.scrollToSection("arecSection");
        },
        async pickCon(id, code, time_1, time_2) {
            this.clearArr();

            if (this.weekend == false) {
                this.isTime = this.setTimer(time_1);
            } else {
                this.isTime = this.setTimer(time_2);
            }
            // console.log(this.isTime);
            await axios
                .get("/api/roomMain/" + id)
                .then((response) => {
                    this.roomList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
                });

            this.tableList = true;
            this.conActive = id;
            this.conLimit = code;
            this.conTime1 = time_1;
            this.conTime2 = time_2;
            this.conGray = false;
            this.data.con_id = id;

            this.scrollToSection("tableSection");
        },
        getReserve() {
            var today = moment().format("YYYY-MM-DD");

            axios
                .get("/api/reserveMain/" + today)
                .then((response) => {
                    this.reserveList = response.data;
                })
                .catch((err) => {
                    // console.log(err);
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
        showModal(id, code, kind) {
            // var today = moment().format("YYYY-MM-DD");

            // axios.get('/api/recordMain/' + today + '/' + )

            this.isModalShow = true;
            this.data.room_id = id;
            this.data.status = kind;
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
                (this.data.code = ""),
                (this.data.status = "");
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

                                this.getReserve();

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
        chkReserve(id, code) {
            var res = this.reserveList.some(
                (selection) =>
                    selection["room_id"] == id && selection["time"] == code
            );
            return res;
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
        showReserve(id, time, limit) {
            const limited = this.chkConLimit(limit);

            if (id != null && time != null) {
                const res = this.reserveList.filter(
                    (selection) =>
                        selection["room_id"] == id && selection["time"] == time
                );

                this.nameReserve = [];

                for (let i = 0; i < Math.min(res.length, limited); i++) {
                    this.nameReserve[i] = res[i].name + " " + res[i].surname;
                    this.chkStatus = res[i].status;
                }

                this.showModalRes = true;
                this.dataCancel.id = id;
                this.dataCancel.time = time;
            }
        },
        chkConLimit(limit) {
            if (limit != null) {
                const res = this.conList.filter(
                    (selection) => selection["id"] == limit
                );

                return res[0].limited;
            }
        },
        closeReserve() {
            this.chkStatus = "";
            this.showModalRes = false;
        },
        cancel() {
            Swal.fire({
                title: "ยกเลิกการจอง?",
                text: "ยืนยันการยกเลิก",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post("/api/delReserve", this.dataCancel)
                        .then((response) => {
                            //console.log(res);

                            //var today = moment().format("YYYY-MM-DD");

                            this.clearArr();
                            this.getReserve();

                            Swal.fire({
                                title: response.data.title,
                                text: response.data.text,
                                icon: response.data.icon,
                            });
                            this.showModalRes = false;
                        })
                        .catch((err) => {
                            //console.log(err);
                            Swal.fire({
                                icon: "error",
                                title: "ไม่สามารถยกเลิกได้",
                                text: "กรุณาติดต่อเจ้าหน้าที่",
                            });
                        });
                }
            });
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
            this.getReserve();
        },
        checkDup(arr) {
            var res = arr.filter((item, index) => arr.indexOf(item) !== index);
            if (res == "") {
                return true;
            } else {
                return false;
            }
        },
        closeCookie() {
            this.cookieModal = false;
        },
        scrollToSection(ref) {
            this.$nextTick(() => {
                const el = this.$refs[ref];
                if (el) {
                    el.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            });
        },
        scrollToLoc() {
            this.scrollToSection("locSection");
        },
    },
    computed: {
        chkLength() {
            if (this.data.time.length > this.chkRule) {
                this.showAlertRule = true;
            } else if (this.data.time.length > 3) {
                this.showAlert = true;
            } else {
                this.showAlert = false;
                this.showAlertRule = false;
            }
        },
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
.cookie-banner {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 15px;
    text-align: center;
}
.cookie-link {
    color: #ffd700;
    text-decoration: none;
}
.cookie-button {
    margin-left: 10px;
    padding: 5px 10px;
    border: none;
}
</style>
