import {
    SIGNOUT,
    DELETE
} from "../store/auctions.type";

export default {
    signOut() {
        App.$store
            .dispatch(SIGNOUT, {})
            .then(() => {
                location.href = "/";
            })
            .catch(error => {});
    },
    makeToast(msg, variant = null) {
        this.$bvToast.toast(msg, {
            title: `Variant ${variant || 'default'}`,
            variant: variant,
            solid: true
        })
    },
}
