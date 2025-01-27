<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex items-center">
                        <box-icon
                            name="menu-alt-left"
                            size="lg"
                            color="#f87171"
                            class="pr-2"
                        ></box-icon
                        ><font class="text-2xl font-semibold text-gray-600"
                            >: สถิติการเข้าใช้งาน</font
                        >
                    </div>

                    <p class="text-red-500">
                        ** ระบบแสดงสถิติย้อนหลัง 3 เดือน **
                    </p>

                    <hr class="my-4 border border-dashed" />

                    <div class="card-body">
                        <p class="flex items-center">
                            <box-icon
                                name="book"
                                size="md"
                                class="pr-2"
                                color="#f59e0b"
                            ></box-icon>
                            : สำนักวิทยบริการ
                        </p>

                        <table class="table-auto border-collapse border mt-4">
                            <thead class="bg-amber-100">
                                <tr>
                                    <th class="p-4 border border-slate-400">
                                        เดือน
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้องเรียนรู้ A
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้องเรียนรู้ B
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้องเรียนรู้ C
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้อง Playground
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้อง Pavilion Room
                                    </th>
                                    <th class="p-4 border border-slate-400">
                                        ห้อง Nap Zone
                                    </th>
                                    <th
                                        class="p-4 border border-slate-400 bg-gray-300"
                                    >
                                        ทั้งหมด
                                    </th>
                                    <th
                                        class="p-4 border border-slate-400 bg-gray-300"
                                    >
                                        หน่วย
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="text-center"
                                    v-for="(stat, index) in statList"
                                    :key="index"
                                >
                                    <td class="p-4 border border-slate-400">
                                        {{ moment(stat.month).format("MMMM") }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["a"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["b"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["c"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["pg"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["pav"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{ stat["nap"] }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        {{
                                            stat["a"] +
                                            stat["b"] +
                                            stat["c"] +
                                            stat["pg"] +
                                            stat["pav"] +
                                            stat["nap"]
                                        }}
                                    </td>
                                    <td class="p-4 border border-slate-400">
                                        คน
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mt-4">
                        <p class="flex items-center">
                            <box-icon
                                name="caret-right-circle"
                                size="md"
                                class="pr-2"
                                color="#334155"
                            ></box-icon>
                            : Digital Learning Park
                        </p>
                    </div>

                    <table class="table-auto border-collapse border mt-4">
                        <thead class="bg-amber-100">
                            <tr>
                                <th class="p-4 border border-slate-400">
                                    เดือน
                                </th>
                                <th class="p-4 border border-slate-400">
                                    ห้องอเนกประสงค์
                                </th>
                                <th class="p-4 border border-slate-400">
                                    ทีวีออนไลน์
                                </th>
                                <th class="p-4 border border-slate-400">
                                    คอมพิวเตอร์
                                </th>
                                <th class="p-4 border border-slate-400">
                                    Game Playstation
                                </th>
                                <th class="p-4 border border-slate-400">
                                    Gmae Online
                                </th>
                                <th class="p-4 border border-slate-400">
                                    Pool Table
                                </th>
                                <th
                                    class="p-4 border border-slate-400 bg-gray-300"
                                >
                                    ทั้งหมด
                                </th>
                                <th
                                    class="p-4 border border-slate-400 bg-gray-300"
                                >
                                    หน่วย
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center"
                                v-for="(stat, index) in statList"
                                :key="index"
                            >
                                <td class="p-4 border border-slate-400">
                                    {{ moment(stat.month).format("MMMM") }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["std"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["tv"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["com"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["play"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["online"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ stat["pool"] }}
                                </td>
                                <td class="p-4 border border-slate-400">
                                    {{ 
                                        stat["std"] + 
                                        stat["tv"] +
                                        stat["com"] +
                                        stat["play"] +
                                        stat["online"] +
                                        stat["pool"]
                                    }}
                                </td>
                                <td class="p-4 border border-slate-400">คน</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "boxicons";
import moment from "moment"; //format date thai
import "moment/dist/locale/th";
moment.locale("th");

export default {
    mounted() {
        this.getStat();
    },
    data() {
        return {
            statList: [],
            moment: moment,
        };
    },
    methods: {
        getStat() {
            axios
                .get("/api/stat")
                .then((response) => {
                    this.statList = response.data;
                    console.log(this.statList);
                })
                .catch((err) => {});
        },
    },
};
</script>
