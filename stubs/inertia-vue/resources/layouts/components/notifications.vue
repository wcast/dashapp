<template>
    <div class="dropdown d-inline-block">
        <button class="btn header-item dropdown-toggle" type="button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-bell-outline mdi-24px"></i>
            <span class="d-none d-sm-inline-block ml-1">
              <i class="mdi mdi-chevron-down d-none d-sm-inline-block mb-1"></i>
            </span>
            <span class="badge badge-danger badge-pill">6</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
             aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-weight-medium text-uppercase"> Notifications </h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge badge-pill badge-danger">New 3</span>
                    </div>
                </div>
            </div>
            <div data-simplebar>
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Your order is placed</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">If several languages coalesce the grammar</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <img src="/assets/images/users/avatar-3.jpg"
                             class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Andrew Mackie</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">It will seem like simplified English.</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="mdi mdi-package-variant-closed"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Your item is shipped</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">One could refuse to pay expensive translators.</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <img src="/assets/images/users/avatar-4.jpg"
                             class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Dominic Kellway</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="p-2 border-top">
                <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                    <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppNotifications"
}
</script>

<style scoped>

</style>
