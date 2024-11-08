package com.sample.matiran.application

import android.app.Application
import com.instabug.library.Instabug
import com.instabug.library.invocation.InstabugInvocationEvent
import dagger.hilt.android.HiltAndroidApp

@HiltAndroidApp
class AppApplication : Application() {

    override fun onCreate() {
        try {
            super.onCreate()
            context = this
            Instabug.Builder(this, "a9d824d85e9cb8a8d20ef66d1a14a3d0")
                .setInvocationEvents(
                    InstabugInvocationEvent.SHAKE,
                    InstabugInvocationEvent.NONE
                )
                .build();
        } catch (e: Exception) {
        }
    }

    companion object {
        lateinit var context: AppApplication
    }
}