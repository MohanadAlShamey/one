<template>
   <div class="container">
      <div class="row justify-content-center">
          <div class="col-12" >


              <div class="card">
                  <div class="card-body text-center" >
                      <img :src="img" class=" img-fluid"  alt="" v-for="joker in jokers">
                  </div>
                  <div class="card-footer text-center" >
                      <button class="btn btn-sm btn-outline-success " @click="pickJoker()">إستخدام جوكر</button>
                  </div>

              </div>

          </div>
      </div>
   </div>
</template>

<script>
    export default {
        name: "JokerComponent",
        props:['img','joker_id'],
        data(){
            return {
                url,
                jokers:null,
            }
        },
        methods:{
            pickJoker(){
                Swal.fire({
                    title: 'هل انت متأكد من إستخدام الجوكر',
                    text: "يسمح لك استخدام 5 جوكر في الشهر مجانا",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد',
                    cancelButtonText:'إلغاء الأمر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(`${url}/student/jokers/${this.jokers[0].id}/pick`).then(()=>{
                            Swal.fire(
                                'تم إستخدام الجوكر بنجاح',
                                '',
                                'success'
                            );
                            this.getAllJockers();
                           // this.$el.parentNode.removeChild(this.$el);
                        })
                    }
                })
            },
            getAllJockers(){
                axios.get(`${url}/student/jokers/getAll`).then(({data})=>{
                    this.jokers=data;
                });

            }
        },
        created(){
           this.getAllJockers()
        }
    }
</script>

<style scoped>
.img-joker{
    width: 100%;
}
</style>