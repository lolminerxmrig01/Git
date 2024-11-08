package com.sample.matiran.view

import android.os.Bundle
import androidx.activity.viewModels
import androidx.lifecycle.Observer
import androidx.navigation.NavController
import androidx.navigation.Navigation
import com.example.matiran.R
import com.example.matiran.databinding.ActivityApplicationBinding
import com.example.matiran.databinding.LoadingDialogBinding
import com.sample.matiran.tools.base.BaseActivity
import com.sample.matiran.tools.base.BaseViewModel
import com.sample.matiran.tools.share.CustomDialog
import com.sample.matiran.viewmodel.ApplicationViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class ApplicationActivity : BaseActivity<ActivityApplicationBinding>() {

//    private val viewModel by viewModels<ApplicationViewModel>()

    private var loadingDialog : CustomDialog<LoadingDialogBinding>? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        BaseViewModel.activityContext = this
        binding = ActivityApplicationBinding.inflate(layoutInflater)
        setContentView(binding.root)

        loadingDialog = CustomDialog(this, false, {LoadingDialogBinding.inflate(layoutInflater)})

        val navController: NavController =
            Navigation.findNavController(this, R.id.nav_host_fragment)

        BaseViewModel.isNotBusy.observe(this, {
            if (it == false){
                loadingDialog?.dialog?.show()
            }else loadingDialog?.dialog?.dismiss()
        })
    }
}