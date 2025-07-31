import { getById } from "../../../components/helper";
import { startCheckIn, stopCheckIn } from "./checkIn";

const btnStartCheckIn = getById("btnStartCheckIn");
btnStartCheckIn.addEventListener("click", async () => {
    await startCheckIn();
});

const btnStopCheckIn = getById("btnStopCheckIn");
btnStopCheckIn.addEventListener("click", () => {
    console.log("stop camera")
    stopCheckIn();
});
