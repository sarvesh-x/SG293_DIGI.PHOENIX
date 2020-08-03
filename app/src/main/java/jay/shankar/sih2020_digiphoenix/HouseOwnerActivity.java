package jay.shankar.sih2020_digiphoenix;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;

public class HouseOwnerActivity extends AppCompatActivity {


    @SuppressLint("SetJavaScriptEnabled")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_house_owner);

                    final WebView mywebview = (WebView) findViewById(R.id.houseOwner_webView);
                    mywebview.setWebViewClient(new WebViewClient());
                    mywebview.getSettings().setJavaScriptEnabled(true);
                    mywebview.setWebChromeClient(new WebChromeClient());
                    mywebview.getSettings().setDomStorageEnabled(true);
                    mywebview.loadUrl("http://gyanamonline.com/rhcms/admin/house_owner.php");

                }

    }
