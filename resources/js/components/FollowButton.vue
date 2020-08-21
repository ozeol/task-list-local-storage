<template style="padding-right:0px;">

<div class="d-flex" style="padding-right:0px;">
<td style="padding-top:0px; padding-right:3px; width:280px; border-color:transparent;">
<p v-bind:style="text_style"> {{ textItem }}</p>
</td>

<form style="padding-right:4px; padding-left:0px; margin-left:0px;">
<button type="button" style="width: 97px; padding-left:9px;" v-bind:class="order_button_style" @click="on_order_button_click()">
{{ buttonText }}
</button>
</form>
</div>
</template>

<script>
export default {
   props: ['itemId', 'item'], required: true,

   data() {
        return {
            status: false,
            item2: JSON.parse(this.item),
             isActive: true,
             error: null
        }
    },
    methods: {
        on_order_button_click() {
            this.status = !this.status;
            localStorage.setItem(this.itemId, this.status);
        }
    },
    mounted() {
        this.status = localStorage.getItem(this.itemId) === "true";
    },
    computed: {
        buttonText() {
            return this.status === true ? "Completed" : "Complete";
        },

textItem() {

  return this.item2.title;

},

        order_button_style() {
            return this.status === true ?
                "btn btn-danger" :
                "btn btn-primary";
    },

       text_style() {
      return this.status === true
        ? "text-decoration: line-through;"
        : "text-decoration: none;";
    }
  
}

};
</script>