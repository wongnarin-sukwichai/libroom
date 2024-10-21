<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex items-center">
                        <box-icon
                            name="bar-chart-alt-2"
                            type="solid"
                            size="md"
                            class="pr-2"
                        ></box-icon
                        ><font class="text-2xl font-semibold text-gray-600">: สถิติการเข้าใช้งาน</font>
                    </div>

                    <div class="card-body mt-8">
                        <p class="flex items-center"> <box-icon
                            name="book"
                            size="md"
                            class="pr-2"
                            color="#f59e0b"
                        ></box-icon
                        > : สำนักวิทยบริการ | Academic Resource Center</p>

                        <table class="table-auto border-collapse border mt-4">
                            <thead class="bg-amber-100">
                                <tr>
                                    <th class="p-4 border border-slate-400">เดือน</th>
                                    <th class="p-4 border border-slate-400">ห้องเรียนรู้ A</th>
                                    <th class="p-4 border border-slate-400">ห้องเรียนรู้ B</th>
                                    <th class="p-4 border border-slate-400">ห้องเรียนรู้ C</th>
                                    <th class="p-4 border border-slate-400">ห้อง Playground</th>
                                    <th class="p-4 border border-slate-400">หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="p-4 border border-slate-400">สิงหาคม</td>
                                    <td class="p-4 border border-slate-400">10</td>
                                    <td class="p-4 border border-slate-400">20</td>
                                    <td class="p-4 border border-slate-400">30</td>
                                    <td class="p-4 border border-slate-400">40</td>
                                    <td class="p-4 border border-slate-400">ชั่วโมง</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mt-8">
                        <p class="flex items-center"> <box-icon
                            name="digitalocean"
                            type="logo"
                            size="md"
                            class="pr-2"
                            color="#334155"
                        ></box-icon
                        > : สำนักวิทยบริการ | Academic Resource Center</p>
                    </div>

                    <table class="table-auto border-collapse border mt-4">
                            <thead class="bg-amber-100">
                                <tr>
                                    <th class="p-4 border border-slate-400">เดือน</th>
                                    <th class="p-4 border border-slate-400">ห้องอเนกประสงค์</th>
                                    <th class="p-4 border border-slate-400">ทีวีออนไลน์</th>
                                    <th class="p-4 border border-slate-400">หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="p-4 border border-slate-400">สิงหาคม</td>
                                    <td class="p-4 border border-slate-400">10</td>
                                    <td class="p-4 border border-slate-400">20</td>
                                    <td class="p-4 border border-slate-400">ชั่วโมง</td>
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

export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
