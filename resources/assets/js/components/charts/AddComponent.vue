

<template>
   <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Add Coin</div>

                <div class="card-body">
                    <form @submit.prevent="addCoin">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" v-model="coin.name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Year</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="coin.year"  required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="coin.price"  required>
                            </div>
                        </div>
                          <div class="form-group row">
                    <label for="year" class="col-md-4 col-form-label text-md-right">Date</label>
                         <div class="col-md-6">  
                        <VueCtkDateTimePicker v-model="start_date" format='YYYY-MM-DD hh:mm' >
                        <input type="text"  class="form-control" format='YYYY-MM-DD'/>
                        </VueCtkDateTimePicker>
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>
<script>

export default {
      data() {
         return {
            coin: {},
            start_date:""
         }
      },
      methods: {
         addCoin() {
            axios.post('coins', this.coin).then((response) => {
               window.location.reload();
            });
         }
      }
   }

   </script>