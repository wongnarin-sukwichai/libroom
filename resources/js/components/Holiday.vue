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
                        <th class="p-2 w-32">วันที่</th>
                        <th class="border p-2">รายละเอียด</th>
                        <th class="border p-2">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border bg-sky-400">
                        <td class="p-4">มกราคม</td>
                    </tr>
                    <tr class="text-center">
                        <td class="border p-2">1</td>
                        <td class="border p-2">วันปีใหม่</td>
                        <td class="border p-2">
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
