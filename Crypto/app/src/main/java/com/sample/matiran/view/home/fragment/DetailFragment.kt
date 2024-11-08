package com.sample.matiran.view.home.fragment

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.navigation.fragment.navArgs
import com.example.matiran.R
import com.example.matiran.databinding.FragmentDetailBinding
import com.sample.matiran.tools.utils.visibleOrGone
import com.sample.matiran.viewmodel.DetailViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DetailFragment : Fragment() {

    val args: DetailFragmentArgs by navArgs()
    private lateinit var binding: FragmentDetailBinding
    private val viewModel by viewModels<DetailViewModel>()

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        // Inflate the layout for this fragment
        binding = FragmentDetailBinding.inflate(inflater, container, false)
        args.cryptoId?.let { binding.item = viewModel.getDetailCryptoById(it.toInt()) }

        binding.imageViewMore.setBackgroundResource(R.drawable.ic_baseline_keyboard_arrow_down_24)

        binding.rootMore.setOnClickListener {
            viewModel.isRootList = !viewModel.isRootList
            binding.percentChangeRoot.visibleOrGone(viewModel.isRootList, true)

            if (viewModel.isRootList) {
                binding.imageViewMore.setBackgroundResource(R.drawable.ic_baseline_keyboard_arrow_up_24)
            } else {
                binding.imageViewMore.setBackgroundResource(R.drawable.ic_baseline_keyboard_arrow_down_24)
            }


        }

        return binding.root
    }
}