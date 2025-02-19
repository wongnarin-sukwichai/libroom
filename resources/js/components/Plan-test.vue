<template>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center my-10">Plan Example</div>

                    <div class="box">5555</div>
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
</template>

<script>
export default {
    mounted() {},
    data() {
        return {
            plan: "/img/plans/1.png",
        };
    },
};
</script>

<style>
@media only screen and (max-width: 480px) {
}
.box {
    height: auto;
    position: absolute;
    margin-left: 18%;
    margin-top: 10%;
    border: solid;
    padding: 2%;
}

@media only screen and (max-width: 1200px) {
}
.box {
    height: auto;
    position: absolute;
    margin-left: 18%;
    margin-top: 10%;
    border: solid;
    padding: 2%;
}
</style>
