<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex card-header">
                        <box-icon
                            name="dots-vertical-rounded"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <box-icon
                            name="time"
                            color="gray"
                            size="md"
                            class="pr-2"
                        ></box-icon>
                        <span class="text-xl py-1">เวลาให้บริการ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-end">
            <button
                class="bg-green-300 hover:bg-green-400 shadow-lg rounded-md p-2 text-sm text-gray-700"
            >
                เพิ่มข้อมูล
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto mt-4">
            <table class="border-collapse border w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 w-12">ID</th>
                        <th class="border p-4">รายละเอียด</th>
                        <th class="border p-4 w-48">จำนวนชั่วโมง/วัน</th>
                        <th class="border p-4">เวลาเริ่มต้น</th>
                        <th class="border p-4">สิ้นสุด</th>
                        <th class="border p-4">แก้ไขล่าสุด</th>
                        <th class="border p-4">วันที่แก้ไข</th>
                        <th class="border p-4">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="border p-4">1</td>
                        <td class="border p-4">เวลาปกติ</td>
                        <td class="border p-4">10</td>
                        <td class="border p-4">08.00 น.</td>
                        <td class="border p-4">18.00 น.</td>
                        <td class="border p-4">วงศ์นรินทร์ สุขวิชัย</td>
                        <td class="border p-4">2024-01-23</td>
                        <td class="border p-4">
                            <div class="flex justify-center">
                                <div>
                                    <box-icon
                                        name="cog"
                                        color="#94a3b8"
                                        size="sm"
                                        animation="tada-hover"
                                        class="cursor-pointer"
                                    ></box-icon>
                                </div>
                                <div class="pl-2">
                                    <box-icon
                                        name="trash"
                                        color="#f87171"
                                        size="sm"
                                        animation="tada-hover"
                                        class="cursor-pointer"
                                    ></box-icon>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td class="border p-4">2</td>
                        <td class="border p-4">เสาร์ - อาทิตย์</td>
                        <td class="border p-4">8</td>
                        <td class="border p-4">10.00 น.</td>
                        <td class="border p-4">18.00 น.</td>
                        <td class="border p-4">วงศ์นรินทร์ สุขวิชัย</td>
                        <td class="border p-4">2024-01-23</td>
                        <td class="flex p-4 justify-center">
                            <div>
                                <box-icon
                                    name="cog"
                                    color="#94a3b8"
                                    size="sm"
                                    animation="tada-hover"
                                    class="cursor-pointer"
                                ></box-icon>
                            </div>
                            <div class="pl-2">
                                <box-icon
                                    name="trash"
                                    color="#f87171"
                                    size="sm"
                                    animation="tada-hover"
                                    class="cursor-pointer"
                                ></box-icon>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
