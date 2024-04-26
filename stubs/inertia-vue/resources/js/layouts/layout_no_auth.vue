<script setup>
import Footer from "@/layouts/footer.vue";
</script>
<template>
    <div id="layout-wrapper">
        <!-- start Account pages -->
        <div class="account-pages">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h5 class="font-size-16 text-white-50 mb-4">

                            </h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card card-auth">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <!-- Authentication - Sign-in -->
                                    <slot/>
                                    <!-- Authentication - Sign-in-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->
        <Footer :auth="true"/>
    </div>
</template>
<style>
.card-auth {
    margin-top: 20%;
}
</style>
