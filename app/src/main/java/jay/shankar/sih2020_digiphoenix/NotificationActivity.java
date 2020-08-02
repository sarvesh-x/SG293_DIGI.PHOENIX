package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import android.annotation.SuppressLint;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ListView;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import jay.shankar.sih2020_digiphoenix.Adapters.NotificationAdapter;
import jay.shankar.sih2020_digiphoenix.LoginActivity;
import jay.shankar.sih2020_digiphoenix.Models.Notification;
import jay.shankar.sih2020_digiphoenix.R;


public class NotificationActivity extends AppCompatActivity {

    private StringRequest request;
    private RequestQueue requestQueue;
    private static final String NOTIFICATIONS_URL = "http://gyanamonline.com/rhcms/sih_files/notifications.php";
    private ArrayList<String> message = new ArrayList<String>();
    private ArrayList<String> subject = new ArrayList<String>();
    private ArrayList<String> date_time = new ArrayList<String>();
    ArrayList<Notification> itemsArrayList = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notification);

        requestQueue = Volley.newRequestQueue(NotificationActivity.this);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        final ListView listNotifications = findViewById(R.id.notification_list);
        final String tender_id = LoginActivity.user.get(2);

        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {
                    request = new StringRequest(Request.Method.POST, NOTIFICATIONS_URL, new Response.Listener<String>() {
                        @SuppressLint("ShowToast")
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONArray array = new JSONArray(response);
                                for(int i=0;i<array.length();i++) {
                                    JSONObject t_array = array.getJSONObject(i);
                                    String sub = t_array.get("date")+"\n"+t_array.get("subject");
                                    String msg = t_array.get("message").toString();

                                    itemsArrayList.add(new Notification(sub,msg));

                                    message.add(i,msg);
                                    subject.add(i,sub);
                                    NotificationAdapter adapter1 = new NotificationAdapter(NotificationActivity.this, itemsArrayList);
                                    listNotifications.setAdapter(adapter1);
                                    adapter1.notifyDataSetChanged();

                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {

                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            HashMap<String, String> hashMap = new HashMap<String, String>();
                            hashMap.put("t_id", tender_id);
                            return hashMap;
                        }
                    };

                    requestQueue.add(request);

                    listNotifications.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            AlertDialog.Builder alert = new AlertDialog.Builder(NotificationActivity.this);
                            alert.setTitle(subject.get(position));
                            alert.setMessage(message.get(position));
                            alert.setPositiveButton("Okay", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {

                                }
                            });
                            alert.setCancelable(true);
                            alert.create();
                            alert.show();
                        }
                    });

                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(NotificationActivity.this);
                    alert.setTitle("Error");
                    alert.setMessage("Connect to Internet for Sending Statistical Usage of App and Development");
                    alert.setPositiveButton("Settings", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.P) {
                                startActivity(new Intent(Settings.ACTION_DATA_USAGE_SETTINGS));
                            }
                        }
                    });
                    alert.setCancelable(false);
                    alert.create();
                    alert.show();
                }
            }
        });
    }


}