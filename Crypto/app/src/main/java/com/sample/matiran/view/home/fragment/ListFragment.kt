package com.sample.matiran.view.home.fragment

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.core.view.isVisible
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.lifecycle.Observer
import androidx.navigation.fragment.findNavController
import com.example.matiran.databinding.FragmentListBinding
import com.sample.matiran.view.home.adapter.ListAdapter
import com.sample.matiran.viewmodel.ListViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class ListFragment : Fragment() {

    private val viewModel by viewModels<ListViewModel>()
    private lateinit var binding: FragmentListBinding

    private val adapter by lazy {
        ListAdapter {
            findNavController().navigate(ListFragmentDirections.actionListToDetail(it))
        }
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        // Inflate the layout for this fragment
        binding = FragmentListBinding.inflate(inflater, container, false)
        viewModel.getCryptoList()

        binding.recyclerView.adapter = adapter

        viewModel.getCurrentCryptoInfo().observe(viewLifecycleOwner, Observer { cryptoList ->

            if(cryptoList.isNotEmpty())
            adapter.submitList(cryptoList as MutableList)

            if (viewModel.isInitList) {
                binding.recyclerView.isVisible = cryptoList.isNotEmpty()
                binding.imgNotFound.isVisible = cryptoList.isEmpty()
            }
        })

        return binding.root
    }


}