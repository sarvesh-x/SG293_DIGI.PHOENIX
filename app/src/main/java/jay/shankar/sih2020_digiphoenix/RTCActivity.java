package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.WindowManager;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class RTCActivity extends AppCompatActivity {



    @SuppressLint("SetJavaScriptEnabled")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_r_t_c);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);

        String t_id = LoginActivity.user.get(2);
        final WebView mywebview = (WebView) findViewById(R.id.chat);
        mywebview.setWebViewClient(new WebViewClient());
        mywebview.getSettings().setJavaScriptEnabled(true);
        mywebview.setWebChromeClient(new WebChromeClient());
        mywebview.getSettings().setDomStorageEnabled(true);
        mywebview.loadUrl("http://gyanamonline.com/rhcms/admin/third/chat.php?id="+t_id);

    }
}