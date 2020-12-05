<template>
    <div class="col-md-8">
        <div class="card " style="background-color:#FFF;border:1px solid #f00">
            <div class="card-body">
                <p class="text-dark"  style="line-height: 1.8">يوم غد السبت هو اليوم الخاص بجلسات اللايف </p>
                <p class="text-dark"  style="line-height: 1.8">يمكنك الاستفادة من يوم غد لإنجاز أي تدريبات أو دروس متراكمة </p>
                <p  class="text-dark" style="line-height: 1.8">وفي حال لديك أي أسئلة لم يتم الإجابة عليها بشكل كافي في الرسائل الصوتية، أو في حال رغبتك
                    بمشاركة شاشة كمبيوترك معي لمناقشة شيء ترغب به

                    فأرجو إعلامي بذلك اليوم قبل الساعة الـ 6 مساء حتى يتم حجز موعد لك في جلسات الزوم بإذن
                    الله </p>
                <p class="d-flex justify-content-between" style="line-height: 1.8">
                    <button class="btn btn-sm btn-success " style="word-break: break-all;max-width:50%;" @click="dontResive">
                        أريد الإستفادة من يوم غد <br>لإنجاز التدريبات <br>والدروس المتراكمة
                    </button>
                    <button class="btn btn-sm btn-secondary" @click="resiveSession">حجز موعد</button>

                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ResiveSession",
        methods:{
            resiveSession(){
                Swal.fire({
                    title: 'هل انت متأكد من حجز الموعد',
                    text: "سيتم تسجيل الحجز",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post(`${url}/student/session`,{type:'pending'}).then(()=>{
                            Swal.fire(
                                'تم تسجيل الحجز',
                                'يرجى مراجعة الموقع بعد الساعة 9:00 مساء لمعرفة موعد الحجز',
                                'success'
                            );
                            this.$el.parentNode.removeChild(this.$el);

                        })
                    }

                })
            },
            dontResive(){
                axios.post(`${url}/student/session`,{type:'no'}).then(()=>{
                    Swal.fire(
                        'أرجو لك التوفيق',
                        '',
                        'success'
                    );
                    this.$el.parentNode.removeChild(this.$el);

                })
            },
        }
    }
</script>

<style scoped>


</style>