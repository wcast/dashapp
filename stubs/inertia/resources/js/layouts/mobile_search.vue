<template>
    <div class="dropdown d-inline-block d-lg-none ml-2 mt-4">
        <button class="btn dropdown-toggle search-mobile-btn" type="button" id="mobile-serch-app" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
        </button>

        <div class="dropdown-menu search-mobile " aria-labelledby="mobile-serch-app" x-placement="bottom-end">
            <form class="p-3">
                <div class="form-group m-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppMobileSerch"
}
</script>

<style scoped>
.search-mobile {
    position: absolute !important;
    transform: translate3d(0px, 70.5px, 0px) !important;
    inset: 0px auto auto 0px !important;
    will-change: transform !important;
    margin: 0px !important;
}

.search-mobile-btn{
    border: none;
}
</style>
