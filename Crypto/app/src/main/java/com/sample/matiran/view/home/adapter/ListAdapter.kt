package com.sample.matiran.view.home.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.databinding.DataBindingUtil
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.example.matiran.R
import com.example.matiran.databinding.AdapterListBinding
import com.sample.matiran.model.Crypto

class ListAdapter(private val itemCallback: ((String) -> Unit)) :
    ListAdapter<Crypto, RecyclerView.ViewHolder>(
        object : DiffUtil.ItemCallback<Crypto>() {
            override fun areItemsTheSame(
                oldItem: Crypto,
                newItem: Crypto
            ): Boolean {
                return oldItem == newItem
            }

            override fun areContentsTheSame(
                oldItem: Crypto,
                newItem: Crypto
            ): Boolean {
                return true
            }
        }
    ) {

    class ListAdapterViewHolder(
        val binding: AdapterListBinding,
        private val itemCallback: ((String) -> Unit)
    ) :
        RecyclerView.ViewHolder(binding.root) {

        fun bind(item: Crypto) {
            binding.item = item
            binding.textViewSymbol.setOnClickListener { itemCallback.invoke(item.id) }
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RecyclerView.ViewHolder {
        val binding = DataBindingUtil.inflate<AdapterListBinding>(
            LayoutInflater.from(parent.context),
            R.layout.adapter_list,
            parent,
            false
        )

        return ListAdapterViewHolder(
            binding, itemCallback
        )
    }

    override fun onBindViewHolder(holder: RecyclerView.ViewHolder, position: Int) {
        (holder as ListAdapterViewHolder).bind(getItem(position))
    }

}