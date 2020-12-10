<template>
    <div class="form-row">
        <div class="col-md-6">
            <label >عنوان للمنتج</label>
            <input type="text" v-model="service.name" class="form-control">
        </div>
        <div class="col-md-6">
            <label >صورة المنتج</label>
            <input type="file" accept="image/jpg,image/png,image/webp,image/gif" @change="changeFile" class="form-control">
        </div>
        <div class="col-md-12">
            <label >وصف قصير للمنتج</label>
            <textarea v-model="service.description" class="form-control"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GalleryTemplate",
        props:{
          name:{
              type:String,
              default:''
          },
          img:{
              type:String,
              default:''
          },
          description:{
              type:String,
              default:''
          }
        },
        data(){
            return {
                service:{
                    name:'',
                    img:'',
                    description:'',
                }
            }
        },
        methods:{
            changeFile(el){
                let file = el.target.files[0];
                let reader = new FileReader();
                reader.onloadend = () => {
                    this.service.img = reader.result

                }
                reader.readAsDataURL(file);
            }
        },
        watch:{
            'service.name':function(){
                this.$emit('change-value',this.service)
            },
            'service.img':function(){
                this.$emit('change-value',this.service)
            },
            'service.description':function(){
                this.$emit('change-value',this.service)
            }
        },
        created(){
          this.service.name=this.name;
          this.service.description=this.description;
          this.service.img=this.img;
        }
    }
</script>

<style scoped>

</style>